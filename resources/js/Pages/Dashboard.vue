<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-if="!todos.length" class="p-6 bg-white border-b border-gray-200">
                        Don't procrastinate! Add new reminders!
                    </div>
                    <div v-for="todo in todos" :key="todo">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <p>{{  todo.name  }}</p>
                            <p>{{  todo.description  }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-4">
                    <form>
                        <label for="name">name:</label>
                        <input id="name" v-model="name" />
                        <label for="description">description:</label>
                        <input id="description" v-model="description" />
                        <button @click="submit()" type="button">Submit</button>
                    </form>
                    <!-- <button class="btn btn-ghost btn-outline">
                        ADD A REMINDER
                    </button> -->
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import { reactive } from 'vue';
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    props: {
        todos: Object,
    },
    components: {
        Link,
    },
    data() {
        return {
            name: '',
            description: ''
        }
    },
    methods: {
        submit() {
            const form = reactive(
                {
                    user_id: 1,
                    name: this.name,
                    description: this.description,
                    priority: 1,
                    completed: false,
                }
            )
            Inertia.post('/create', form)
        }
    }
};
</script>
