<template>
    <Head title="Cart" />

    <AuthenticatedLayout>
        <div class="container mx-auto mt-8">
            <h1 class="text-2xl font-bold mb-6">Shopping Cart</h1>
            <div v-if="cartStore.cartItems.length > 0">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2">Product</th>
                            <th class="py-2">Quantity</th>
                            <th class="py-2">Price</th>
                            <th class="py-2">Total</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr v-for="item in cartStore.cartItems" :key="item.id">
                            <td class="border px-4 py-2">{{ item.product.name }}</td>
                            <td class="border px-4 py-2">
                                <input 
                                    v-model.number="item.quantity"  
                                    type="number" 
                                    min="1" 
                                    class="border p-2 w-20 text-center" 
                                />
                            </td>
                            <td class="border px-4 py-2">R {{ item.product.price }}</td>
                            <td class="border px-4 py-2">R {{ item.quantity * item.product.price }}</td>
                            <td class="border px-4 py-2">
                                <button @click="removeFromCart(item.id)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                    Remove
                                </button>
                                <button @click="saveQuantity(item.id, item.quantity)" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded ml-2">
                                    Save
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-6 text-right">
                    <p class="text-lg font-bold">Total: R {{ cartStore.totalCartValue }}</p>
                </div>
            </div>
            <div v-else>
                <p>Your cart is empty.</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useCartStore } from '@/Stores/cartStore';
import { onMounted } from 'vue';

export default {
    components: {
        AuthenticatedLayout,
        Head,
    },
    props: {
        cartItems: Array, // Receive cartItems from the backend
    },
    setup(props) {
        const cartStore = useCartStore();

        // syncing the passed props (cartItems) to the Pinia store
        onMounted(() => {
            cartStore.setCartItems(props.cartItems); // Calling the action to sync items
        });

        const removeFromCart = (productId) => {
            cartStore.removeFromCart(productId);
        };

        
        const saveQuantity = (cartItemId, quantity) => {
        cartStore.updateQuantity(cartItemId, quantity);
         };
         

        return {
            cartStore,
            removeFromCart,
            saveQuantity,
        };
    },
};
</script>