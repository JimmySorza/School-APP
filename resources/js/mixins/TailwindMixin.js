// Imports
import resolveConfig from 'tailwindcss/resolveConfig'
import tailwindConfig from '../../../tailwind.config.js'

const fullConfig = resolveConfig(tailwindConfig)

export default {
  data () {
    return {
      tailwindColors: fullConfig.theme.colors
    }
  }
}
