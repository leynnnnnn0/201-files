<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { UserRound, CircleUserRound, Lock } from "lucide-vue-next";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <div
        class="bg-gradient-to-r from-pink-300 via-purple-400 to-blue-500 flex gap-12 justify-center min-h-screen max-h-screen items-center sm:p-20 p-5 grid-cols-1"
    >
        <div class="flex flex-col items-center justify-center">
            <section
                class="bg-white/60 h-fit w-96 rounded-2xl relative p-10 shadow-xl"
            >
                <div
                    class="bg-blue-900 w-fit p-5 rounded-full absolute -top-10 left-1/2 transform -translate-x-1/2"
                >
                    <UserRound class="text-white font-bold size-12" />
                </div>

                <div class="flex flex-col gap-3 mt-12">
                    <div class="flex w-full">
                        <div
                            class="flex items-center justify-center bg-blue-900 p-3"
                        >
                            <CircleUserRound class="font-bold text-white" />
                        </div>
                        <input
                            id="email"
                            type="email"
                            v-model="form.email"
                            required
                            autofocus
                            class="flex-1 bg-blue-900/80 text-white placeholder-white/40"
                            placeholder="Email ID"
                        />
                    </div>

                    <div class="flex w-full">
                        <div
                            class="flex items-center justify-center bg-blue-900 p-3"
                        >
                            <Lock class="font-bold text-white" />
                        </div>
                        <input
                            id="password"
                            type="password"
                            v-model="form.password"
                            required
                            class="flex-1 bg-blue-900/80 text-white placeholder-white/40"
                            placeholder="Password"
                        />
                    </div>

                    <InputError :message="form.errors.email" />

                    <div class="flex items-center justify-between mt-3">
                        <div class="block">
                            <label class="flex items-center">
                                <Checkbox
                                    name="remember"
                                    v-model:checked="form.remember"
                                />
                                <span
                                    class="ms-2 sm:text-sm text-xs text-blue-900"
                                    >Remember me</span
                                >
                            </label>
                        </div>
                    </div>
                </div>
            </section>

            <button
                @click="submit"
                class="text-white bg-white/60 shadow-xl font-bold px-32 rounded-lg py-2 hover:bg-pink-300"
            >
                LOGIN
            </button>
        </div>
    </div>
</template>
