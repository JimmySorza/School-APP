// Imports
import SubjectsImportCSVView from '../../views/subjects/SubjectsImportCSVView'
import SubjectsView from '../../views/subjects/SubjectsView'
import SubjectsDetailsView from '../../views/subjects/SubjectsDetailsView'

export default [
  {
    component: SubjectsView,
    name: 'SubjectsView',
    path: '/:tenant_id/subjects',
    meta: {
      requiresAuth: true,
      breadcrumbs: [
        {
          title: 'Classes',
          path: 'SubjectsView'
        }
      ]
    }
  },
  {
    component: SubjectsDetailsView,
    name: 'SubjectsDetailsView',
    path: '/:tenant_id/subjects/:id',
    meta: {
      requiresAuth: true,
    },
    beforeEnter(to, from, next) {
      if (!to.params.subject) {
        next({ name: 'SubjectsView' })
      } else {
        to.meta.breadcrumbs = [{ title: 'Classes', path: 'SubjectsView' }, { title: to.params.subject.name }]

        next()
      }
    }
  },
  {
    component: SubjectsImportCSVView,
    name: 'SubjectsImportCSVView',
    path: '/:tenant_id/subjects/import-csv',
    meta: {
      requiresAuth: true,
      breadcrumbs: [
        { title: 'Classes', path: 'SubjectsView' },
        { title: 'Import CSV' }
      ]
    }
  }
]
