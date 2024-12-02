<template>
    <AdminLayout>
      <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
          <div class="sm:flex-auto">
            <h1 class="text-lg font-semibold text-gray-900">Feature Flags</h1>
            <p class="mt-2 text-base text-gray-700">A list of all the feature flags in your account including their name and status.</p>
          </div>
          <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
              <!-- <button type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-base font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Feature</button> -->
          </div>
        </div>
        <div class="mt-8 flow-root">
          <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
              <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                  <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-base font-semibold text-gray-900 sm:pl-6">Feature Name</th>
                      <th scope="col" class="px-3 py-3.5 text-left text-base font-semibold text-gray-900">Enabled</th>
                      <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only">Toggle</span>
                      </th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-200 bg-white">
                    <tr v-for="feature in sortedFeatures" :key="feature.id">
                      <td class="whitespace-nowrap py-4 pl-4 pr-3 text-base font-medium text-gray-900 sm:pl-6">{{ feature.feature_name }}</td>
                      <td class="whitespace-nowrap px-3 py-4 text-base text-gray-500">{{ feature.is_enabled ? 'Yes' : 'No' }}</td>
                      <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-base font-medium sm:pr-6">
                        <label class="inline-flex items-center cursor-pointer">
                          <input type="checkbox" v-model="feature.is_enabled" @change="toggleFeature(feature)" class="sr-only">
                          <div :class="['w-12 h-6 rounded-full transition-colors duration-200 ease-in-out', feature.is_enabled ? 'bg-green-500' : 'bg-red-500']"></div>
                          <div :class="['dot absolute left-20.5 top-0.2 w-5 h-5 bg-white rounded-full shadow transform transition-transform duration-200 ease-in-out', feature.is_enabled ? 'translate-x-6' : 'translate-x-0']"></div>
                        </label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AdminLayout>
  </template>
  
  <script setup>
  import { defineProps, computed } from 'vue';
  import { useForm } from '@inertiajs/vue3';
  import AdminLayout from "@/Layouts/AdminLayout.vue";
  
  const props = defineProps({
    features: Array
  });
  
  const form = useForm({
    is_enabled: false,
  });
  
  const sortedFeatures = computed(() => {
    return [...props.features].sort((a, b) => a.id - b.id);
  });
  
  const toggleFeature = (feature) => {
    form.is_enabled = feature.is_enabled;
    form.put(`/admin/features/${feature.id}`, {
      onSuccess: () => {
        const updatedFeature = props.features.find(f => f.id === feature.id);
        if (updatedFeature) {
          updatedFeature.is_enabled = form.is_enabled;
        }
      }
    });
  };
  </script>