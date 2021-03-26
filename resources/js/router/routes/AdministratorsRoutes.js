// Imports
import AdministratorsView from '../../views/administrators/AdministratorsView'
import AdministratorsDetailsView from '../../views/administrators/AdministratorsDetailsView'
import AdministratorsImportCSVView from '../../views/administrators/AdministratorsImportCSVView'

export default [
  {
    component: AdministratorsImportCSVView,
    name: 'AdministratorsImportCSVView',
    path: '/:tenant_id/administrators/import-csv',
    meta: {
      requiresAuth: true,
      breadcrumbs: [
        { title: 'Administrators', path: 'AdministratorsView' },
        { title: 'Import CSV' }
      ]
    }
  },
  {
    component: AdministratorsView,
    name: 'AdministratorsView',
    path: '/:tenant_id/administrators',
    meta: {
      requiresAuth: true,
      breadcrumbs: [
        { title: 'Administrators' }
      ]
    }
  },
  {
    component: AdministratorsDetailsView,
    name: 'AdministratorsDetailsView',
    path: '/:tenant_id/administrators/:id',
    meta: {
      requiresAuth: true,
    },
    beforeEnter(to, from, next) {
      if (!to.params.administrator) {
        next({ name: 'AdministratorsView' })
      } else {
        to.meta.breadcrumbs = [{ title: 'Administrators', path: 'AdministratorsView' }, { title: to.params.administrator.name }]

        next()
      }
    }
  }
]
