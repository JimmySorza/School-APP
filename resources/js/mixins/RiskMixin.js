export default {
  methods: {
    // Get Risk Level Background
    getRiskLevelBackground (level) {
      switch (level) {
        case 'low':
          return 'bg-success'
        case 'moderate':
          return 'bg-warning'
        case 'high':
          return 'bg-danger'
        default:
          return 'bg-black'
      }
    },

    getRiskLevelText (level) {
      switch (level) {
        case 'high':
          return ['text-danger']
        case 'moderate':
          return ['text-warning']
        case 'low':
          return ['text-success']
        default:
          return ['text-black']
      }
    }
  }
}
