// Imports
import StudentsView from '../../views/students/StudentsView'
import StudentsDetailsView from '../../views/students/StudentsDetailsView'
import StudentsImportCSVView from '../../views/students/StudentsImportCSVView'

export default [
  {
    component: StudentsImportCSVView,
    name: 'StudentsImportCSVView',
    path: '/:tenant_id/students/import-csv',
    meta: {
      requiresAuth: true,
      breadcrumbs: [
        { title: 'Students', path: 'StudentsView' },
        { title: 'Import CSV' }
      ]
    }
  },
  {
    component: StudentsView,
    name: 'StudentsView',
    path: '/:tenant_id/students',
    meta: {
      requiresAuth: true,
      breadcrumbs: [
        { title: 'Students' }
      ]
    }
  },
  {
    component: StudentsDetailsView,
    name: 'StudentsDetailsView',
    path: '/:tenant_id/students/:id',
    meta: {
      requiresAuth: true,
    },
    beforeEnter(to, from, next) {
      if (!to.params.student) {
        next({ name: 'StudentsView' })
      } else {
        to.meta.breadcrumbs = [{ title: 'Students', path: 'StudentsView' }, { title: to.params.student.name }]

        next()
      }
    }
  }
]
