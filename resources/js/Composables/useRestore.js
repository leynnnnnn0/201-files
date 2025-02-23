import useAlert from "@/Composables/useAlert.js";
import { router } from "@inertiajs/vue3";
export default function useRestore(model) {
    const { confirm, toast } = useAlert();
    const restoreModel = (route) => {
        confirm.require({
            message: `Are you sure you want to restore this ${model.toLowerCase()}?`,
            header: "Confirmation",
            icon: "pi pi-exclamation-triangle",
            rejectProps: {
                label: "Cancel",
                severity: "secondary",
                outlined: true,
            },
            acceptProps: {
                label: "Confirm",
                severity: "info",
            },
            accept: () => {
                router.post(route, {
                    onSuccess: () => {
                        toast.add({
                            severity: "success",
                            summary: "Success",
                            detail: `${model} Restored Successfully.`,
                            life: 5000,
                        });
                        console.log("ccuess");
                    },
                    onError: () => {
                        toast.add({
                            severity: "error",
                            summary: "Error",
                            detail: `An error occured while trying to restore this ${model.toLowerCase()}.`,
                            life: 5000,
                        });
                    },
                });
                toast.add({
                    severity: "success",
                    summary: "Success",
                    detail: `${model} Restored Successfully.`,
                    life: 5000,
                });
            },
        });
    };
    return {
        restoreModel,
    };
}
