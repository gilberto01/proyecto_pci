<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Suavización exponencial
            </h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                        <div class="-mx-3 mb-3">
                            <div class="w-full px-3 mb-4">
                                <label class="block uppercase Titulos tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    1.	Pronóstico del periodo anterior
                                </label>
                                <input v-model="pronostico" v-on:keyup="Resultado" @change="Resultado" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" type="number" placeholder="Ejemplo: 22000">
                            </div>
                            <div class="w-full px-3 mb-4">
                                <label class="block uppercase Titulos tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    2. Suavización exponencial
                                </label>
                                <input v-model="suavizacion" v-on:keyup="Resultado" @change="Resultado" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" type="number" placeholder="Ejemplo: 0.10">
                            </div>
                            <div class="w-full px-3 mb-4">
                                <label class="block uppercase Titulos tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    3. Demanda real del periodo anterior
                                </label>
                                <input v-model="demanda" v-on:keyup="Resultado" @change="Resultado" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" type="number" placeholder="Ejemplo: 21000">
                            </div>
                        </div>
                    </div>
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/1 px-3 mb-6 md:mb-0">
                                <label class="block uppercase Titulos tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    4.	Pronósticos de la demanda
                                </label>
                                <p class="mt-4">Formula:</p>
                                <label class="block LetraFinal tracking-wide text-grey-darker font-bold mb-2 mt-3">
                                    (Pronóstico del periodo anterior + (Suavización exponencial * (Demanda real del periodo anterior - Pronóstico del periodo anterior) ) )
                                </label>
                                <p class="mt-4">Resultado:</p>
                                <label class="block LetraFinal tracking-wide text-grey-darker font-bold mb-2 mt-3">
                                    ({{pronostico}} + ({{suavizacion}} * ({{demanda}} - {{pronostico}}) ) ) = <span v-bind:class="{ 'text-red-700' : Resultado() === 'Datos incompletos' , 'text-blue-700' : Resultado() !== 'Datos incompletos' }">{{Resultado()}}</span>
                                </label>
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
        name: "SuavizacionExponencial",
        components: {
            AppLayout,
        },
        data() {
            return {
                pronostico: null,
                suavizacion: null,
                demanda: null,
                resultado: null
            }
        },
        computed:{
        },
        methods:{
            Resultado(){

                var resultado = 0;

                if(this.pronostico && this.suavizacion && this.demanda){
                    resultado = (parseFloat(this.pronostico)+ (parseFloat(this.suavizacion)* (parseFloat(this.demanda)- parseFloat(this.pronostico)) ));
                }

                if (isNaN(resultado)) {
                    return 'Datos incompletos';
                }
                return resultado;
            }
        }
    }
</script>

<style scoped>
    .BtnPrincipal{
        margin-top: 30px;
    }
    .Titulos{
        font-size: 14px;
    }
    .LetraFinal{
        font-size: 17px;
    }
</style>