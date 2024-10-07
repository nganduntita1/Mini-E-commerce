<template>
    <Head title="Products" />
    
    <AuthenticatedLayout>
            <div class="container mx-auto mt-8"> 
                <h1 class="text-2xl font-bold mb-6">Product List</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="product in products" :key="product.id" class="bg-white p-6 rounded-lg shadow-md">
                    <img :src="product.image" alt="Product Image" class="w-full h-48 object-cover mb-4" />
                    <h2 class="text-xl font-semibold mb-2">{{ product.name }}</h2>
                    <p class="text-gray-600 mb-4">{{ product.description }}</p>
                    <p class="text-lg font-bold">R {{ product.price }} </p>
                    <div class="mt-4">
                        <input v-model.number="product.quantity" type="number" min="1" class="border p-2 w-20 text-center" />
                        <button @click="addToCart(product)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add to Cart
                        </button>
                    </div>
                    </div>
                </div>
            </div>
   </AuthenticatedLayout>
</template>

<script >
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

export default {
    components: {
            AuthenticatedLayout,
            Head
        },
  data() {
    return { 
        // I will change this in future to populate data from the database
      products: [
        {
          id: 1,
          name: 'Product 1',
          description: 'This is a product',
          price: 20,
          image: 'https://e7.pngegg.com/pngimages/88/823/png-clipart-logo-product-design-brand-trademark-new-product-promotion-blue-text.png',
          quantity: 1,
        },
        {
          id: 2,
          name: 'Product 2',
          description: 'This is another product',
          price: 35,
          image: 'https://e7.pngegg.com/pngimages/88/823/png-clipart-logo-product-design-brand-trademark-new-product-promotion-blue-text.png',
          quantity: 1,
        },
      ],
    };
  },
  methods: {
    addToCart(product) {
    },
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