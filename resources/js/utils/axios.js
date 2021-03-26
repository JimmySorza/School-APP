import axios from 'axios'
import { getTenant } from './getTenant'

/**
 * Create Axios Instance for API Call
 *
 * @param {boolean} withToken
 * @param {boolean} withTenant
 * @param { { headers: Object, baseURL: string } } options
 */
export const createAxiosInstance = (
  withToken = true,
  withTenant = true,
  options = {}
) => {
  const {
    headers = {},
    baseURL = `${process.env.MIX_API_URL}/api/${
      withTenant ? 'tenant/' + getTenant() : ''
    }`,
  } = options

  const instanceConfig = {
    baseURL: baseURL,
    headers: {
      'Content-Type': 'application/json',
      'X-XSRF-TOKEN': document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content'),
      ...(withToken
        ? { Authorization: `Bearer ${localStorage.getItem('token')}` }
        : {}),
      ...headers,
    },
  }
  console.log('~~~~ instanceConfig', instanceConfig)

  const axiosInstance = axios.create(instanceConfig)

  axiosInstance.interceptors.request.use((config) => {
    /* ----------------------------- API Call Start ----------------------------- */
    console.log('[===== Started API Call =====]')
    return config
  })

  axiosInstance.interceptors.response.use((response) => {
    /* ------------------------------ API Call End ------------------------------ */
    console.log('[===== Ended API Call =====]')
    return response
  })
  return axiosInstance
}

export default createAxiosInstance
