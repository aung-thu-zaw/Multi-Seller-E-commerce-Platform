import { useFormatFunctions } from '@/Composables/useFormatFunctions'
import { useReCaptcha } from 'vue-recaptcha-v3'
import { __ } from '@/Services/translations-inside-setup.js'
import { inject, ref } from 'vue'
import { router, useForm, usePage } from '@inertiajs/vue3'
import { useQueryStringParams } from './useQueryStringParams'
import { useStore } from 'vuex'

export function useResourceActions(formFields = {}) {
  const swal = inject('$swal')
  const store = useStore()
  const processing = ref(false)
  const errors = ref(null)

  // Use Format Functions
  const { formatToSnakeCase, formatToTitleCase } = useFormatFunctions()

  // URI Query String Parameters
  const { queryStringParams } = useQueryStringParams()

  // Dynamic Form Fields For ( Create and Edit )
  const form = useForm({ ...formFields, captcha_token: null })

  // Google ReCaptcha Version 3
  const { executeRecaptcha, recaptchaLoaded } = useReCaptcha()

  // Create Action
  const createAction = async (entityType, createRouteName) => {
    await recaptchaLoaded()
    form.captcha_token = await executeRecaptcha(`create_${formatToSnakeCase(entityType)}`)
    processing.value = true

    router.post(
      route(createRouteName),
      {
        ...form,
        page: 1,
        per_page: queryStringParams.value.per_page,
        sort: 'id',
        direction: 'desc'
      },
      {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          const successMessage = usePage().props.flash.success
          if (successMessage) {
            swal({
              icon: 'success',
              title: __(successMessage, {
                label: __(entityType)
              })
            })
          }
        },
        onFinish: () => (processing.value = false),
        onError: (backendErrors) => {
          errors.value = backendErrors
        }
      }
    )
  }

  // Edit Action
  const editAction = async (entityType, editRouteName, targetIdentifier, method = 'patch') => {
    await recaptchaLoaded()
    form.captcha_token = await executeRecaptcha(`edit_${formatToSnakeCase(entityType)}`)
    processing.value = true

    router.post(
      route(editRouteName, {
        [formatToSnakeCase(entityType)]: targetIdentifier
      }),
      {
        _method: method === 'put' || method === 'patch' ? method : undefined,
        ...form,
        ...queryStringParams.value
      },
      {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          const successMessage = usePage().props.flash.success
          if (successMessage) {
            swal({
              icon: 'success',
              title: __(successMessage, {
                label: __(entityType)
              })
            })
          }
        },
        onFinish: () => (processing.value = false),
        onError: (backendErrors) => {
          errors.value = backendErrors
        }
      }
    )
  }

  // Change Status Action
  const changeStatusAction = async (entityType, editRouteName, targetIdentifier, currentStatus) => {
    const result = await swal({
      icon: 'question',
      title: __('Change :label Status', {
        label: __(formatToTitleCase(entityType))
      }),
      text: __('Are you sure you would like to do this?'),
      showCancelButton: true,
      confirmButtonText: __('Confirm'),
      cancelButtonText: __('Cancel'),
      confirmButtonColor: '#d52222',
      cancelButtonColor: '#626262',
      timer: 20000,
      timerProgressBar: true,
      reverseButtons: true
    })

    if (result.isConfirmed) {
      router.post(
        route(editRouteName, {
          [formatToSnakeCase(entityType)]: targetIdentifier
        }),
        {
          _method: 'patch',
          status: currentStatus,
          ...queryStringParams.value
        },
        {
          preserveScroll: true,
          onSuccess: () => {
            const successMessage = usePage().props.flash.success
            if (successMessage) {
              swal({
                icon: 'success',
                title: __(successMessage, {
                  label: __(entityType)
                })
              })
            }
          }
        }
      )
    }
  }

  // Soft Delete Action
  const softDeleteAction = async (entityType, deleteRouteName, targetIdentifier) => {
    const result = await swal({
      icon: 'question',
      title: __('Delete :label', {
        label: __(formatToTitleCase(entityType))
      }),
      text:
        __('Are you sure you would like to do this?') + __('It can be restored within 60 days.'),
      showCancelButton: true,
      confirmButtonText: __('Confirm'),
      cancelButtonText: __('Cancel'),
      confirmButtonColor: '#d52222',
      cancelButtonColor: '#626262',
      timer: 20000,
      timerProgressBar: true,
      reverseButtons: true
    })

    if (result.isConfirmed) {
      router.delete(
        route(deleteRouteName, {
          [formatToSnakeCase(entityType)]: targetIdentifier,
          ...queryStringParams.value
        }),
        {
          preserveScroll: true,
          onSuccess: () => {
            const successMessage = usePage().props.flash.success
            if (successMessage) {
              swal({
                icon: 'success',
                title: __(successMessage, {
                  label: __(entityType)
                })
              })
            }
          }
        }
      )
    }
  }

  // Soft Delete Selected Action
  const softDeleteSelectedAction = async (entityTypes, deleteRouteName, selectedItems) => {
    const result = await swal({
      icon: 'question',
      title: __('Delete Selected :label', {
        label: __(formatToTitleCase(entityTypes))
      }),
      text:
        __('Are you sure you would like to do this?') + __('It can be restored within 60 days.'),
      showCancelButton: true,
      confirmButtonText: __('Confirm'),
      cancelButtonText: __('Cancel'),
      confirmButtonColor: '#d52222',
      cancelButtonColor: '#626262',
      timer: 20000,
      timerProgressBar: true,
      reverseButtons: true
    })

    if (result.isConfirmed) {
      router.delete(
        route(deleteRouteName, {
          selected_items: selectedItems,
          ...queryStringParams.value
        }),
        {
          preserveScroll: true,
          onFinish: () => {
            store.dispatch('setSelectedItems', [])
          },
          onSuccess: () => {
            const successMessage = usePage().props.flash.success
            if (successMessage) {
              swal({
                icon: 'success',
                title: __(successMessage, {
                  label: __(entityTypes)
                })
              })
            }
          }
        }
      )
    }
  }

  // Restore Action
  const restoreAction = async (entityType, restoreRouteName, targetIdentifier) => {
    const result = await swal({
      icon: 'question',
      title: __('Restore :label', {
        label: __(formatToTitleCase(entityType))
      }),
      text: __('Are you sure you would like to restore this?'),
      showCancelButton: true,
      confirmButtonText: __('Confirm'),
      cancelButtonText: __('Cancel'),
      confirmButtonColor: '#2562c4',
      cancelButtonColor: '#626262',
      timer: 20000,
      timerProgressBar: true,
      reverseButtons: true
    })

    if (result.isConfirmed) {
      router.post(
        route(restoreRouteName, {
          id: targetIdentifier
        }),
        {
          ...queryStringParams.value
        },
        {
          preserveScroll: true,
          onSuccess: () => {
            const successMessage = usePage().props.flash.success

            if (successMessage) {
              swal({
                icon: 'success',
                title: __(successMessage, {
                  label: __(entityType)
                })
              })
            }
          }
        }
      )
    }
  }

  // Selected Restore Action
  const restoreSelectedAction = async (entityTypes, restoreRouteName, selectedItems) => {
    const result = await swal({
      icon: 'question',
      title: __('Restore Selected :label', {
        label: formatToTitleCase(__(entityTypes))
      }),
      text: __('Are you sure you would like to restore these?'),
      showCancelButton: true,
      confirmButtonText: __('Confirm'),
      cancelButtonText: __('Cancel'),
      confirmButtonColor: '#2562c4',
      cancelButtonColor: '#626262',
      timer: 20000,
      timerProgressBar: true,
      reverseButtons: true
    })

    if (result.isConfirmed) {
      router.post(
        route(restoreRouteName, {
          selected_items: selectedItems
        }),
        {
          ...queryStringParams.value
        },
        {
          preserveScroll: true,
          onFinish: () => {
            store.dispatch('setSelectedItems', [])
          },
          onSuccess: () => {
            const successMessage = usePage().props.flash.success

            if (successMessage) {
              swal({
                icon: 'success',
                title: __(successMessage, {
                  label: __(entityTypes)
                })
              })
            }
          }
        }
      )
    }
  }

  // Permanent Delete Action
  const permanentDeleteAction = async (entityType, deleteRouteName, targetIdentifier) => {
    const result = await swal({
      icon: 'question',
      title: __('Permanently Delete :label', {
        label: formatToTitleCase(__(entityType))
      }),
      text: __('This action cannot be undone. Are you sure you want to permanently delete this?'),
      showCancelButton: true,
      confirmButtonText: __('Confirm'),
      cancelButtonText: __('Cancel'),
      confirmButtonColor: '#d52222',
      cancelButtonColor: '#626262',
      timer: 20000,
      timerProgressBar: true,
      reverseButtons: true
    })

    if (result.isConfirmed) {
      router.delete(
        route(deleteRouteName, {
          id: targetIdentifier,
          ...queryStringParams.value
        }),
        {
          preserveScroll: true,
          onSuccess: () => {
            const successMessage = usePage().props.flash.success
            if (successMessage) {
              swal({
                icon: 'success',
                title: __(successMessage, {
                  label: __(entityType)
                })
              })
            }
          }
        }
      )
    }
  }

  // Selected Permanent Delete Action
  const permanentDeleteSelectedAction = async (entityTypes, deleteRouteName, selectedItems) => {
    const result = await swal({
      icon: 'question',
      title: __('Permanently Delete Selected :label', {
        label: formatToTitleCase(__(entityTypes))
      }),
      text: __(
        'This action cannot be undone. Are you sure you want to permanently delete the selected :label in the trash?',
        { label: __(entityTypes.toLowerCase()) }
      ),
      showCancelButton: true,
      confirmButtonText: __('Confirm'),
      cancelButtonText: __('Cancel'),
      confirmButtonColor: '#d52222',
      cancelButtonColor: '#626262',
      timer: 20000,
      timerProgressBar: true,
      reverseButtons: true
    })

    if (result.isConfirmed) {
      router.delete(
        route(deleteRouteName, {
          selected_items: selectedItems,
          ...queryStringParams.value
        }),
        {
          preserveScroll: true,
          onFinish: () => {
            store.dispatch('setSelectedItems', [])
          },
          onSuccess: () => {
            const successMessage = usePage().props.flash.success
            if (successMessage) {
              swal({
                icon: 'success',
                title: __(successMessage, {
                  label: __(entityTypes)
                })
              })
            }
          }
        }
      )
    }
  }

  // Permanent Delete All Action
  const permanentDeleteAllAction = async (entityTypes, deleteRouteName) => {
    const result = await swal({
      icon: 'question',
      title: __('Permanently Delete All :label', {
        label: __(formatToTitleCase(entityTypes))
      }),
      text: __(
        'This action cannot be undone. Are you sure you want to permanently delete all :label in the trash?',
        { label: __(formatToTitleCase(entityTypes)) }
      ),
      showCancelButton: true,
      confirmButtonText: __('Confirm'),
      cancelButtonText: __('Cancel'),
      confirmButtonColor: '#d52222',
      cancelButtonColor: '#626262',
      timer: 20000,
      timerProgressBar: true,
      reverseButtons: true
    })

    if (result.isConfirmed) {
      router.delete(
        route(deleteRouteName, {
          ...queryStringParams.value
        }),
        {
          preserveScroll: true,
          onSuccess: () => {
            const successMessage = usePage().props.flash.success
            if (successMessage) {
              swal({
                icon: 'success',
                title: __(successMessage, {
                  label: __(entityTypes)
                })
              })
            }
          }
        }
      )
    }
  }

  return {
    form,
    processing,
    createAction,
    editAction,
    changeStatusAction,
    softDeleteAction,
    softDeleteSelectedAction,
    restoreAction,
    restoreSelectedAction,
    permanentDeleteAction,
    permanentDeleteSelectedAction,
    permanentDeleteAllAction,
    errors
  }
}
