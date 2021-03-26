// Imports
import TeachersView from '../../views/teachers/TeachersView'
import TeachersDetailsView from '../../views/teachers/TeachersDetailsView'
import TeachersImportCSVView from '../../views/teachers/TeachersImportCSVView'

export default [
  {
    component: TeachersImportCSVView,
    name: 'TeachersImportCSVView',
    path: '/:tenant_id/teachers/import-csv',
    meta: {
      requiresAuth: true,
      breadcrumbs: [
        { title: 'Teachers', path: 'TeachersView' },
        { title: 'Import CSV' }
      ]
    }
  },
  {
    component: TeachersView,
    name: 'TeachersView',
    path: '/:tenant_id/teachers',
    meta: {
      requiresAuth: true,
      breadcrumbs: [
        {
          title: 'Teachers',
          path: 'TeachersView'
        }
      ]
    }
  },
  {
    component: TeachersDetailsView,
    name: 'TeachersDetailsView',
    path: '/:tenant_id/teachers/:id',
    meta: {
      requiresAuth: true,
    },
    beforeEnter(to, from, next) {
      if (!to.params.teacher) {
        next({ name: 'TeachersView' })
      } else {
        to.meta.breadcrumbs = [{ title: 'Teachers', path: 'TeachersView' }, { title: to.params.teacher.name }]

        next()
      }
    }
  }
]
