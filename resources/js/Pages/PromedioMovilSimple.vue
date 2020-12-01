<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Promedio móvil simple
            </h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/3 px-3 mb-4 md:mb-0">
                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                                    1.	Numero de periodos
                                </label>
                                <input v-model="numero_periodos" v-on:keyup.enter="CrearCampos()" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="number" placeholder="Ejemplo: 10">
                            </div>
                            <div class="md:w-2/3 px-3">
                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">
                                    2. Cantidad de periodos que se quiere calcular
                                </label>
                                <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-last-name" type="number" placeholder="Ejemplo: 4">
                            </div>
                        </div>
                        <hr>
                        <div class="-mx-3 md:flex flex-wrap mt-4 mb-6">
                            <div class="md:w-1/4 px-3 mb-6 md:mb-0" v-for="(item,index) in demandas">
                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                                    Demanda No. {{index + 1}}
                                </label>
                                <input v-model="demandas[index]" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" type="number" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                                    3.	Resultados
                                </label>
                                <h2></h2>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout';

    export default {
        name: "PromedioMovilSimple",
        components: {
            AppLayout,
        },
        data() {
            return {
                numero_periodos: null,
                periodos: null,
                demandas: [],
                resultado: null
            }
        },
        computed:{
          Calcular(){
              const items = arr.slice(Math.max(arr.length - 5, 1));
              console.log(items);
          },
        },
        methods:{
            CrearCampos(){

                this.demandas = [];

                var campo = {};

                for(var i=1; i<= this.numero_periodos; i++){
                    this.demandas.push(campo);
                }
            }
        }
    }
</script>

<style scoped>

</style>