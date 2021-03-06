const elementClickKey = '_vueDismissClick'
const elementKeyupKey = '_vueDismissKeyup'

function setup (el, binding) {
  let callback, shouldBind

  if (typeof binding.value === 'function') {
    callback = binding.value
    shouldBind = true
  } else {
    callback = binding.value.callback
    shouldBind = Object.prototype.hasOwnProperty.call(binding.value, 'watch')
      ? Boolean(binding.value.watch)
      : true
  }

  if (shouldBind) {
    if (typeof document !== 'undefined' && !el[elementClickKey]) {
      const handler = (event) => {
        if (event.keyCode) {
          event.keyCode === 27 && callback()
        } else if (!(event.target === el) && !el.contains(event.target)) {
          callback()
        }
      }

      setTimeout(() => {
        document.addEventListener('click', handler)
        document.addEventListener('keyup', handler)
      }, 10)

      el[elementClickKey] = el[elementKeyupKey] = handler
    }
  } else {
    unbind(el)
  }
}

function unbind (el) {
  if (el[elementClickKey] && typeof document !== 'undefined') {
    document.removeEventListener('click', el[elementClickKey])
    document.removeEventListener('keyup', el[elementKeyupKey])
    delete el[elementClickKey]
    delete el[elementKeyupKey]
  }
}

export default {
  directives: {
    onDismiss: {
      bind: setup,
      unbind,
      update: setup
    }
  }
}
