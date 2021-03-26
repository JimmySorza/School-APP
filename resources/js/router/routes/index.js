// Imports
import AuthRoutes from "./AuthRoutes";

import AdministratorsRoutes from "./AdministratorsRoutes";
import StudentsRoutes from "./StudentsRoutes";
import SubjectsRoutes from "./SubjectsRoutes";
import TeachersRoutes from "./TeachersRoutes";
import TracesRoutes from "./TracesRoutes";
import TenantsRoutes from "./tenants"
export default [
    ...AuthRoutes,
    ...AdministratorsRoutes,
    ...StudentsRoutes,
    ...SubjectsRoutes,
    ...TeachersRoutes,
    ...TracesRoutes,
    ...TenantsRoutes
];
