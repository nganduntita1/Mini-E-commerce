<template>
    <head title="Cart" />

    <AuthenticatedLayout>
        
    <div class="container mx-auto mt-8">
      <h1 class="text-2xl font-bold mb-6">Shopping Cart</h1>
      <div v-if="cart.length > 0">
        <table class="min-w-full bg-white">
          <thead>
            <tr>
              <th class="py-2">Product</th>
              <th class="py-2">Quantity</th>
              <th class="py-2">Price</th>
              <th class="py-2">Total</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in cart" :key="item.id">
              <td class="border px-4 py-2">{{ item.name }}</td>
              <td class="border px-4 py-2">{{ item.quantity }}</td>
              <td class="border px-4 py-2">R {{ item.price }} </td>
              <td class="border px-4 py-2">R {{ item.quantity * item.price }} </td>
            </tr>
          </tbody>
        </table>
        <div class="mt-6 text-right">
          <p class="text-lg font-bold">Total: R {{ totalCartValue }} </p>
        </div>
      </div>
      <div v-else>
        <p>Your cart is empty.</p>
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
      cart: [
        {
          id: 1,
          name: 'Sample Product 1',
          price: 20,
          quantity: 2,
        },
        {
          id: 2,
          name: 'Sample Product 2',
          price: 35,
          quantity: 1,
        },
      ],
    };
  },
  computed: {
    totalCartValue() {
      return this.cart.reduce((total, item) => total + item.price * item.quantity, 0);
    },
  },
};
</script>