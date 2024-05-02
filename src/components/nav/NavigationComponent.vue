<script setup>
    import { RouterLink, RouterView } from 'vue-router'
    import { ref } from 'vue';
    import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
    import { ChevronDownIcon } from '@heroicons/vue/20/solid';

    const open = ref(false);

    const links = ref([
        {id: 1, name: "Home", to: '/'},
        {id: 2, name: "Stock", to: '/stock'},
        {id: 3, name: "Accessories", to: '/accessories'},
        {id: 4, name: "Services", to: '/services'},
        {id: 5, name: "Blog", to: '/blog'},
        {id: 6, name: "Contact Us", to: '/contactUs'},
        {id: 7, name: "Add Car", to: '/addCar'},
    ]);

    const menuOpen = () => {
        open.value = !open.value;
    };
</script>
<template>
    <header>
        <div class="bg-gray-900 p-4 md:flex md:items-center justify-between px-4">
            <div class="logo text-xl font-bold text-white cursor-pointer">
                <h1>GearGalaxy</h1>
            </div>
            <ul 
            class="md:flex gap-5 items-center absolute md:static bg-gray-900 w-full md:w-auto pb-10 md:pb-0 px-6 md:px-0 top-14"
            :class="[open ? 'left-0' : 'left-[-100%]']"
            >
                <li v-for="link in links" :key="link.id" class=" text-white text-decoration-line: none my-4 md:my-0 hover:text-green-400 duration-300 text-xl">
                   <RouterLink :to="link.to">{{link.name}}</RouterLink>
                </li>
            </ul>
            <div id="nav-profile" class="flex gap-5 md:right-0 md:static absolute right-20 top-3 cursor-pointer ">
                <img src="../../assets/images/no-image-3.jpg" alt="no image" class="w-10 rounded-full"/>
                <div>
                    <Menu as="div" class="relative inline-block text-left">
                        <div>
                            <MenuButton class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                Profile
                                <ChevronDownIcon class="-mr-1 h-5 w-5 text-gray-400" aria-hidden="true" />
                            </MenuButton>
                        </div>
                        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="py-1">
                                <MenuItem v-slot="{ active }">
                                    <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Account settings</a>
                                </MenuItem>
                                <form method="POST" action="#">
                                    <MenuItem v-slot="{ active }">
                                    <button type="submit" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block w-full px-4 py-2 text-left text-sm']">Login</button>
                                    </MenuItem>
                                </form>
                                <form method="POST" action="#">
                                    <MenuItem v-slot="{ active }">
                                    <button type="submit" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block w-full px-4 py-2 text-left text-sm']">Sign out</button>
                                    </MenuItem>
                                </form>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
            </div>
            <span class="text-white text-4xl absolute right-6 top-3 cursor-pointer md:invisible" @click="menuOpen">
                <i :class="[open ? 'bi bi-x-square' : 'bi bi-filter-left']"></i>
            </span>
        </div>
  </header>
  <RouterView />
</template>