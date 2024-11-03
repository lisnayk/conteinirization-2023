<template>
    <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold mb-6 text-center">Ваше ПІБ та номер групи</h1>
        <h2 class="text-4xl font-bold mb-6 text-center">Articles (<small>{{articlesUrl}}</small>)</h2>
        <p v-if="loading" class="text-center">Loading articles...</p>
        <div v-if="articles.length" class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <div v-for="article in articles" :key="article.title" class="bg-white shadow-md rounded-lg overflow-hidden">
                <img :src="article.image" alt="Article image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-2xl font-semibold mb-2">{{ article.title }}</h2>
                    <p class="text-gray-700">{{ article.description }}</p>
                </div>
            </div>
        </div>
        <h2 class="mt-5 text-4xl font-bold mb-6 text-center">Users (<small>{{usersUrl}}</small>)</h2>
        <div v-if="users.length" class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div v-for="user in users" :key="user.id" class="bg-white shadow-md rounded-lg overflow-hidden">
                <img :src="user.image" alt="Article image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-2xl font-semibold mb-2">{{ user.username }}</h2>
                    <p class="text-gray-700">{{ user.email }}</p>
                </div>
            </div>
        </div>
        <p v-else class="text-center">No data</p>
    </div>
</template>

<script lang="ts" setup>
import {onMounted, ref} from 'vue';

const articles = ref<any[]>([]);
const users = ref<any[]>([]);
const loading = ref(false);
const articlesUrl = import.meta.env.VITE_ARTICLES_URL;
const usersUrl = import.meta.env.VITE_USERS_URL;

const fetchArticles = async () => {
    try {
        loading.value = true;
        const response = await fetch(articlesUrl);
        if (!response.ok) throw new Error('Failed to fetch articles');
        articles.value = await response.json();
    } catch (error) {
        console.error("Can't load data from", articlesUrl);
    } finally {
        loading.value = false
    }
};
const fetchUsers = async () => {
    try {
        loading.value = true;
        const response = await fetch(usersUrl);
        if (!response.ok) throw new Error('Failed to fetch users');
        users.value = await response.json();
    } catch (error) {
        console.error("Can't load data from", usersUrl);
    } finally {
        loading.value = false
    }
};

onMounted(()=>{
    fetchArticles();
    fetchUsers();
})
</script>

<style scoped>
/* Приклад базового стилю */
h1 {
    color: #333;
}
</style>
