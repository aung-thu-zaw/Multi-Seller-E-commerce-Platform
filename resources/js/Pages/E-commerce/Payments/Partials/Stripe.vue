<template>
  <div class="p-16">
    <div class="p-5 border mx-auto shadow">
      <form @submit.prevent="handleSubmit">
        <input type="hidden" name="payment_method_id" v-model="paymentMethodId" />

        <div class="mb-5">
          <InputLabel label="Credit or debit card" />
          <div id="card-element" class="form-control"></div>
          <div id="card-errors" role="alert" class="text-red-600"></div>
        </div>

        <div class="mb-5">
          <FormButton :processing="processing"> Pay Now </FormButton>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { loadStripe } from '@stripe/stripe-js'
import { router, usePage } from '@inertiajs/vue3'
import FormButton from '@/Components/Buttons/FormButton.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { __ } from '@/Services/translations-inside-setup'

export default {
  components: {
    FormButton,
    InputLabel
  },
  data() {
    return {
      stripe: null,
      card: null,
      paymentMethodId: null,
      processing: false,
      paymentError: null,
      paymentSuccess: null
    }
  },
  async mounted() {
    this.stripe = await loadStripe(this.stripeKey)
    this.card = this.stripe.elements().create('card')

    this.card.mount('#card-element')

    // Handle real-time validation errors from the card Element.
    this.card.addEventListener('change', (event) => {
      const displayError = document.getElementById('card-errors')
      if (event.error) {
        displayError.textContent = event.error.message
      } else {
        displayError.textContent = ''
      }
    })
  },
  props: {
    stripeKey: String,
    totalAmount: Number,
    shippingRate: Number
  },
  methods: {
    async handleSubmit() {
      this.processing = true
      this.paymentError = null
      this.paymentSuccess = null

      const { error, paymentMethod } = await this.stripe.createPaymentMethod({
        type: 'card',
        card: this.card
      })

      if (error) {
        this.paymentError = error.message
        this.processing = false
      } else {
        this.paymentMethodId = paymentMethod.id

        router.post(
          route('payments.stripe.pay', {
            payment_method_id: this.paymentMethodId,
            total_amount: this.totalAmount,
            shipping_fee: this.shippingRate['rate']
          }),
          {},
          {
            preserveScroll: true,
            onSuccess: () => {
              this.paymentSuccess = 'Payment successful'
              this.processing = false
              const successMessage = usePage().props.flash.success
              toast.success(__(successMessage), {
                autoClose: 2000
              })
            }
          }
        )
      }
    }
  }
}
</script>

<style>
label {
  display: block;
  margin-bottom: 5px;
}

.form-control {
  height: 40px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: none;
}
</style>
