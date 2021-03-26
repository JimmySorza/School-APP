// Imports
import TracesView from '../../views/traces/TracesView'
import TracesImportCSVView from '../../views/traces/TracesImportCSVView'

export default [
  {
    component: TracesImportCSVView,
    name: 'TracesImportCSVView',
    path: '/:tenant_id/traces/import-csv',
    meta: {
      requiresAuth: true,
      breadcrumbs: [
        { title: 'Traces', path: 'TracesView' },
        { title: 'Import CSV' }
      ]
    }
  },
  {
    component: TracesView,
    name: 'TracesView',
    path: '/:tenant_id/traces',
    meta: {
      requiresAuth: true,
      breadcrumbs: [
        {
          title: 'Traces',
          path: 'TracesView'
        }
      ]
    }
  }
]
