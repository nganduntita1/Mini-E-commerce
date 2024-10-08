<template>
    <Head title="Products" />

    <AuthenticatedLayout>
        <div class="container mx-auto mt-8">
            <h1 class="text-2xl font-bold mb-6">Product List</h1>

            <!-- Category Filter -->
            <div class="mb-4">
                <label for="categoryFilter" class="block mb-2">Filter by Category:</label>
                <select v-model="selectedCategory" @change="filterProducts" id="categoryFilter" class="border py-2 rounded">
                    <option value="">All Categories</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                </select>
            </div>

            <!-- Displaying Products -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="product in filteredProducts" :key="product.id" class="bg-white p-6 rounded-lg shadow-md">
                    <img :src="product.image_url" alt="Product Image" class="w-full h-48 object-cover mb-4" />
                    <h2 class="text-xl font-semibold mb-2">{{ product.name }}</h2>
                    <p class="text-gray-600 mb-4">{{ product.description }}</p>
                    <p class="text-lg font-bold">R {{ product.price }}</p>
                    <div class="mt-4">
                        <div class="py-2 grid grid-cols-2 gap-3 place-items-stretch ">
                            
                            <input v-model.number="product.tempQuantity" type="number" min="1" class="border grid-cols-2 p-1 w-14 text-center rounded" />
                            <button @click="addToCart(product)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add to Cart
                            </button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed, onMounted, watch } from 'vue';
import { useCartStore } from '@/Stores/cartStore'; 

export default {
    components: {
        AuthenticatedLayout,
        Head,
    },
    props: {
        products: Array, 
        categories: Array,
    },
    setup(props) {
        const cartStore = useCartStore(); 
        const selectedCategory = ref(''); 

        // Function to set default temporary quantity for products
        const setDefaultQuantities = () => {
            props.products.forEach((product) => {
                product.tempQuantity = 1; 
            });
        };

        
        onMounted(() => {
            setDefaultQuantities();
        });

        // Watching for changes in the cart items so that we can update the temporary quantities
        watch(
            () => cartStore.cartItems, 
            (newVal, oldVal) => {
                setDefaultQuantities();
            },
            { immediate: true } 
        );

        
        watch(
            () => props.products,
            (newProducts, oldProducts) => {
                // Reset quantities if products change
                setDefaultQuantities(); 
            }
        );

        // Filtering products by selected category
        const filteredProducts = computed(() => {
            if (!selectedCategory.value) return props.products; 
            return props.products.filter(product => product.category_id === selectedCategory.value);
        });

        
        const addToCart = (product) => {
            if (product.tempQuantity <= 0) {
                product.tempQuantity = 1; 
            }
            cartStore.addToCart(product.id, product.tempQuantity); 
        };

        return {
            selectedCategory,
            filteredProducts,
            addToCart,
        };
    },
};
</script>






<style scoped>
.product-card {
    transition: transform 0.3s;
}
.product-card:hover {
    transform: scale(1.05);
}
</style>