import "../css/app.css";
import "./bootstrap";
import "primeicons/primeicons.css";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import MainLayout from "./Layouts/MainLayout.vue";
import DivFlexCenter from "./Components/div/DivFlexCenter.vue";
import DivFlexCol from "./Components/div/DivFlexCol.vue";
import TableContainer from "./Components/table/TableContainer.vue";
import Table from "./Components/table/Table.vue";
import TD from "./Components/table/TD.vue";
import TH from "./Components/table/TH.vue";
import TableHead from "./Components/table/TableHead.vue";
import TableBody from "./Components/table/TableBody.vue";
import Pagination from "./Components/table/Pagination.vue";
import Heading from "./Pages/text/Heading.vue";
import {
    Filter,
    Eye,
    Pencil,
    Trash2,
    EllipsisVertical,
    Minus,
    Plus,
    MonitorCog,
    Download,
} from "lucide-vue-next";
import ShowButton from "./Components/button/ShowButton.vue";
import EditButton from "./Components/button/EditButton.vue";
import DeleteButton from "./Components/button/DeleteButton.vue";
import LinkButton from "./Components/button/LinkButton.vue";
import DivHeading from "./Components/div/DivHeading.vue";
import Input from "./Components/ui/input/Input.vue";
import PrimeVue from "primevue/config";
import Aura from "@primevue/themes/aura";
import ToastService from "primevue/toastservice";
import ConfirmationService from "primevue/confirmationservice";
import Button from "./Components/ui/button/Button.vue";
import { Link } from "@inertiajs/vue3";
import InputLabel from "./Components/form/InputLabel.vue";
import Textarea from "./Components/ui/textarea/Textarea.vue";
import Label from "./Components/ui/label/Label.vue";
import FormError from "./Components/form/FormError.vue";
import InputContainer from "./Components/form/InputContainer.vue";
import SearchBar from "./Components/table/SearchBar.vue";
import TableHeader from "./Components/table/TableHeader.vue";
import BackButton from "./Components/BackButton.vue";
import SelectItem from "./Components/ui/select/SelectItem.vue";
import FormSelect from "./Components/form/FormSelect.vue";
import FormInput from "./Components/form/FormInput.vue";
const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .component("MainLayout", MainLayout)
            .component("DivFlexCenter", DivFlexCenter)
            .component("DivFlexCol", DivFlexCol)
            .component("TableContainer", TableContainer)
            .component("Table", Table)
            .component("TD", TD)
            .component("TH", TH)
            .component("TableHead", TableHead)
            .component("TableHeader", TableHeader)
            .component("TableBody", TableBody)
            .component("Pagination", Pagination)
            .component("Heading", Heading)
            .component("Pencil", Pencil)
            .component("Trash2", Trash2)
            .component("Eye", Eye)
            .component("ShowButton", ShowButton)
            .component("DeleteButton", DeleteButton)
            .component("EditButton", EditButton)
            .component("LinkButton", LinkButton)
            .component("Button", Button)
            .component("Input", Input)
            .component("InputLabel", InputLabel)
            .component("Textarea", Textarea)
            .component("Link", Link)
            .component("Label", Label)
            .component("FormError", FormError)
            .component("InputContainer", InputContainer)
            .component("SearchBar", SearchBar)
            .component("BackButton", BackButton)
            .component("DivHeading", DivHeading)
            .component("SelectItem", SelectItem)
            .component("FormSelect", FormSelect)
            .component("FormInput", FormInput)
            .use(ToastService)
            .use(ConfirmationService)
            .use(PrimeVue, {
                theme: {
                    preset: Aura,
                    options: {
                        prefix: "p",
                        darkModeSelector: false || "none",
                        cssLayer: false,
                    },
                },
            })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
