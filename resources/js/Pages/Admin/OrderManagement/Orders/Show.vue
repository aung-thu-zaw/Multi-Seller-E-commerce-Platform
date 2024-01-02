<script setup>
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue'
import Breadcrumb from '@/Components/Breadcrumbs/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Breadcrumbs/BreadcrumbItem.vue'
import TableContainer from '@/Components/Tables/TableContainer.vue'
import Table from '@/Components/Tables/Table.vue'
import TableHeaderCell from '@/Components/Tables/TableCells/TableHeaderCell.vue'
import TableDataCell from '@/Components/Tables/TableCells/TableDataCell.vue'
import ImageCell from '@/Components/Tables/TableCells/TableImageCell.vue'
import InputLabel from '@/Components/Forms/Fields/InputLabel.vue'
import SelectBox from '@/Components/Forms/Fields/SelectBox.vue'
import NormalButton from '@/Components/Buttons/NormalButton.vue'
import GoBackButton from '@/Components/Buttons/GoBackButton.vue'
import { Head, router, usePage } from '@inertiajs/vue3'
import { __ } from '@/Services/translations-inside-setup.js'
import { useFormatFunctions } from '@/Composables/useFormatFunctions'
import { computed, ref, watch } from 'vue'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

const props = defineProps({ order: Object })

const orderStatus = ref(props.order?.status)
const paymentStatus = ref(props.order?.payment_status)

const { formatAmount } = useFormatFunctions()

const formattedAttributes = (attributes) => {
  if (!attributes) return ''

  const parsedAttributes = JSON.parse(attributes)

  return Object.entries(parsedAttributes)
    .map(([key, value]) => `${key}: ${value}`)
    .join(', ')
}

const subTotal = computed(() => {
  return props.order.order_items.reduce((accumulator, currentItem) => {
    const numericTotalPrice = parseFloat(currentItem.total_price)
    return accumulator + numericTotalPrice
  }, 0)
})

const printInvoice = () => {
  window.print()
}

watch(orderStatus, (newOrderStatus) => {
  router.patch(
    route('admin.orders.status.update', { order: props.order?.id }),
    {
      order_status: newOrderStatus
    },
    {
      preserveScroll: true,
      onSuccess: () => {
        const successMessage = usePage().props.flash.success
        if (successMessage) {
          toast.success(__(successMessage, { label: __('Order status') }), {
            autoClose: 2000
          })
        }
      }
    }
  )
})

watch(paymentStatus, (newPaymentStatus) => {
  router.patch(
    route('admin.orders.payment.update', { order: props.order?.id }),
    {
      payment_status: newPaymentStatus
    },
    {
      preserveScroll: true,
      onSuccess: () => {
        const successMessage = usePage().props.flash.success
        if (successMessage) {
          toast.success(__(successMessage, { label: __('Payment status') }), {
            autoClose: 2000
          })
        }
      }
    }
  )
})
</script>

<template>
  <Head :title="__('Order Details')" />

  <AdminDashboardLayout>
    <!-- Breadcrumb And Trash Button  -->
    <div class="min-h-screen py-10 font-poppins">
      <div
        class="flex flex-col items-start md:flex-row md:items-center md:justify-between mb-4 md:mb-8"
      >
        <Breadcrumb to="admin.claims-as-a-seller.index" icon="fa-boxes-packing" label="Orders">
          <BreadcrumbItem :label="order?.invoice_no" />
        </Breadcrumb>

        <GoBackButton />
      </div>

      <div class="border bg-white rounded-md shadow p-10">
        <div id="print-document" class="space-y-5 mb-10">
          <div>
            <h2 class="font-bold text-md text-gray-700 mb-6">
              Order Invoice -
              <span class="text-orange-600 text-xs font-bold">{{ order.invoice_no }}</span>
            </h2>

            <div class="space-y-5 flex items-start justify-between">
              <div class="flex flex-col space-y-6">
                <div class="space-y-1 font-bold text-gray-900">
                  <h3 class="text-md mb-1.5 text-gray-800">Delivery Information</h3>
                  <p class="text-xs capitalize">
                    Name : <span class="text-gray-600">{{ order.address?.name }}</span>
                  </p>
                  <p class="text-xs">
                    Email :
                    <span class="text-gray-600">
                      {{ order.address?.email }}
                    </span>
                  </p>

                  <p class="text-xs capitalize">
                    Phone :
                    <span class="text-gray-600">{{ order.address?.phone }}</span>
                  </p>

                  <p class="text-xs capitalize">
                    Address :
                    <span class="text-gray-600">{{ order.address?.address }}</span>
                  </p>

                  <p class="text-xs capitalize">
                    Postal Code :
                    <span class="text-gray-600">{{ order.address?.postal_code }}</span>
                  </p>
                </div>

                <div class="space-y-1 font-bold text-gray-900">
                  <h3 class="text-md mb-1.5 text-gray-800">Payment Information</h3>
                  <p class="text-xs capitalize">
                    Method : <span class="text-gray-600">{{ order.payment_method }}</span>
                  </p>
                  <p class="text-xs">
                    Transaction Id :
                    <span class="text-gray-600">{{
                      order.transaction?.transaction_id ?? '-'
                    }}</span>
                  </p>
                  <p class="text-xs capitalize">
                    Status :
                    <span
                      :class="{
                        'text-green-600': order.payment_status === 'completed',
                        'text-blue-600': order.payment_status === 'pending'
                      }"
                    >
                      {{ order?.payment_status }}
                    </span>
                  </p>
                </div>
              </div>
              <div class="space-y-1 font-bold text-gray-700 text-right">
                <h3 class="text-md mb-1.5">Order Date</h3>
                <p class="text-xs capitalize">{{ order.created_at }}</p>
              </div>
            </div>
          </div>

          <hr />
          <div>
            <h2 class="font-bold text-md text-gray-700 mb-3">
              <i class="fa-solid fa-clipboard-list"></i>
              Order Summary
            </h2>
            <p class="text-xs font-medium text-gray-600">All items here can't be deleted.</p>
          </div>
          <TableContainer>
            <Table :items="order.order_items">
              <!-- Table Header -->
              <template #table-header>
                <TableHeaderCell label="Image" />
                <TableHeaderCell label="Item" />
                <TableHeaderCell label="Attributes" />
                <TableHeaderCell label="Price" />
                <TableHeaderCell label="Qty" />
                <TableHeaderCell label="Total" />
              </template>

              <!-- Table Body -->
              <template #table-data="{ item }">
                <ImageCell :src="item?.product?.image" />

                <TableDataCell>
                  <div class="min-w-[150px]">
                    {{ item?.product?.name }}
                  </div>
                </TableDataCell>

                <TableDataCell>
                  <div v-if="item.attributes" class="min-w-[200px] capitalize">
                    {{ formattedAttributes(item?.attributes) }}
                  </div>
                  <div v-else>-</div>
                </TableDataCell>

                <TableDataCell> $ {{ formatAmount(item?.unit_price) }} </TableDataCell>

                <TableDataCell>
                  {{ item?.qty }}
                </TableDataCell>

                <TableDataCell> $ {{ formatAmount(item?.total_price) }} </TableDataCell>
              </template>
            </Table>
          </TableContainer>

          <div class="flex items-start justify-between">
            <div class="w-1/2">
              <form v-show="can('orders.edit')" class="space-y-4 md:space-y-6 w-[200px]">
                <div>
                  <InputLabel :label="__('Payment Status')" required />

                  <SelectBox
                    name="status"
                    :options="[
                      {
                        label: 'Pending',
                        value: 'pending'
                      },
                      {
                        label: 'Completed',
                        value: 'completed'
                      }
                    ]"
                    :placeholder="__('Select an option')"
                    :selected="paymentStatus"
                    v-model="paymentStatus"
                    required
                  />
                </div>
                <div>
                  <InputLabel :label="__('Order Status')" required />

                  <SelectBox
                    name="status"
                    :options="[
                      {
                        label: 'Pending',
                        value: 'pending'
                      },
                      {
                        label: 'Processing',
                        value: 'processing'
                      },
                      {
                        label: 'Shipped',
                        value: 'shipped'
                      },
                      {
                        label: 'Delivered',
                        value: 'delivered'
                      }
                    ]"
                    :placeholder="__('Select an option')"
                    :selected="orderStatus"
                    v-model="orderStatus"
                    required
                  />
                </div>
              </form>
            </div>
            <div class="w-1/2 text-right font-semibold text-gray-500 text-xs space-y-5">
              <div class="space-y-1">
                <p>Subtotal</p>

                <p class="text-sm font-bold text-gray-700">${{ subTotal }}</p>
              </div>
              <div class="space-y-1">
                <p>Shipping Fee (+)</p>
                <p class="text-sm font-bold text-gray-700">
                  ${{ formatAmount(order.shipping_fee) }}
                </p>
              </div>
              <div class="space-y-1">
                <p>Coupon (-)</p>

                <p
                  v-if="order.coupon_amount && order.coupon_type"
                  class="text-sm font-bold text-gray-700"
                >
                  <span v-if="order.coupon_type === 'fixed'">
                    ${{ formatAmount(order.coupon_amount) }}
                  </span>
                  <span v-if="order.coupon_type === 'percentage'">
                    %{{ formatAmount(order.coupon_amount) }}
                  </span>
                </p>
                <p v-else class="text-sm font-bold text-gray-700">$ 0</p>
              </div>
              <div class="space-y-1">
                <p>Total</p>
                <p class="text-sm font-bold text-gray-700">
                  ${{ formatAmount(order.total_amount) }}
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="flex items-center justify-end">
          <NormalButton @click="printInvoice">
            <i class="fa-solid fa-print"></i> Print
          </NormalButton>
        </div>
      </div>
    </div>
  </AdminDashboardLayout>
</template>

<style scoped>
@media print {
  body * {
    visibility: hidden;
  }
  #print-document,
  #print-document * {
    visibility: visible;
  }
  #print-document {
    position: absolute;
    left: 0;
    top: 0;
  }

  header,
  nav,
  footer,
  time,
  a[href^='http'],
  a[href^='https'],
  a[rel='noopener noreferrer'][target='_blank'] {
    display: none !important;
  }
}

iframe[src^="https://www.google.com/recaptcha"]
{
  display: none !important;
}
</style>
