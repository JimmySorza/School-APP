export default {
    data() {
        return {
            loading: false
        }
    },
    methods: {
        showLoader() {
            this.loading = true
        },
        hideLoader() {
            this.loading = false
        }

    }
}
