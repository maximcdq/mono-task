import CreateClient from "./components/pages/CreateClient";
import EditClient from "./components/pages/EditClient";
import Clients from "./components/pages/Clients";
import View from "./components/pages/ViewCars"

const routes = [
    {path: '/', name: 'home', component: Clients},
    {path: '/edit/client-:id', name: 'edit', component: EditClient},
    {path: '/create', name: 'create', component: CreateClient},
    {path: '/view', name: 'view', component: View}
]

export default routes
