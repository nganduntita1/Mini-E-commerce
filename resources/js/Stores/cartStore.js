import { defineStore } from 'pinia';
import { router } from '@inertiajs/vue3';

export const useCartStore = defineStore('cart', {
    state: () => ({
        cartItems: [],
    }),

    actions: {
        setCartItems(items) {
            this.cartItems = items;
        },

        // Add to cart
        async addToCart(productId, quantity) {
            try {
                await router.post('/cart/add', {
                    product_id: productId,
                    quantity: quantity,
                });
                
            } catch (error) {
                console.error("Error adding to cart:", error);
            }
        },
        // Syncing the store with the data from cart
        async fetchCart() {
            try {
                const response = await router.get('/cart');
                this.setCartItems(response.props.cartItems);  
            } catch (error) {
                console.error("Error fetching cart:", error);
            }
        },

        // Remove from cart
       async removeFromCart(cartId) {
            try {
                // Sending delete request to the backend
                await router.delete(`/cart/remove/${cartId}`);

                
                this.cartItems = this.cartItems.filter(item => item.id !== cartId); // Remove from the state
            } catch (error) {
                console.error("Error removing from cart:", error);
            }
        },

        // Updating item quantity in cart
        async updateQuantity(cartItemId, newQuantity) {
            try {
                // Sending a PUT request to the server to update the quantity
                await router.put(`/cart/update/${cartItemId}`, {
                    quantity: newQuantity,
                });

                // Update the cart item's quantity in the frontend store
                const item = this.cartItems.find(item => item.id === cartItemId);
                if (item) {
                    item.quantity = newQuantity;
                }
            } catch (error) {
                console.error("Error updating cart quantity:", error);
            }
        },

    },

    getters: {
        // Formating the total amount to 2 decimal places
        totalCartValue: (state) => {
            return state.cartItems.reduce((total, item) => {
                const itemPrice = parseFloat(item.product.price) || 0; 
                const itemQuantity = parseInt(item.quantity) || 0; 
                return total + itemQuantity * itemPrice;
            }, 0).toFixed(2); 
        },
    },
});
