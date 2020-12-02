<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Promedio móvil ponderado
            </h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                        <div class="-mx-3 md:flex mb-3">
                            <div class="md:w-1/2 px-3 mb-4 md:mb-0">
                                <label class="block uppercase Titulos tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    1.	Numero de periodos
                                </label>
                                <input v-model="numero_periodos" v-on:keyup="CrearCampos" @change="CrearCampos" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="number" placeholder="Ejemplo: 10">
                            </div>
                            <div class="md:w-1/2 px-3">
                                <label class="block uppercase Titulos tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">
                                    2. Periodos a calcular
                                </label>
                                <input v-model="no_periodos_calcular" v-on:keyup="CrearPonderacion" @change="CrearPonderacion" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-last-name" type="number" placeholder="Ejemplo: 4">
                            </div>
                        </div>
                        <hr>
                        <label class="mt-5 block uppercase Titulos tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">
                            4. Ingresar las demandas
                        </label>
                        <div class="-mx-3 md:flex flex-wrap mt-4 mb-6">
                            <div class="md:w-1/4 px-3 mb-6 md:mb-0" v-for="(item,index) in demandas">
                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    Periodo No. {{index + 1}}
                                </label>
                                <input v-model="demandas[index]" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" v-bind:class="{'border-t-4 border-l-4 border-r-4 border-b-4 border-red-400' : ActivarCampo(index) }" type="number" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                        <div class="-mx-3 md:flex mb-0">
                            <div class="md:w-1/1 px-3 mb-6 md:mb-0">
                                <label class="block uppercase Titulos tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    5.	Ingresar ponderación
                                </label>
                                <div class="-mx-3 md:flex flex-wrap mt-4 mb-6">
                                    <div class="md:w-1/4 px-3 mb-6 md:mb-0" v-for="(item,index) in ponderacion">
                                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                            Periodo No. {{numero_periodos - no_periodos_calcular + (index + 1)}}
                                        </label>
                                        <input v-model="ponderacion[index]" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" type="number" placeholder="Ejem: .5">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/1 px-3 mb-6 md:mb-0">
                                <label class="block uppercase Titulos tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    6.	Pronosticos de la demanda
                                </label>
                                <p class="mt-4">Formula:</p>
                                <label class="block uppercase LetraFinal tracking-wide text-grey-darker text-xs font-bold mb-2 mt-3">
                                    ( <span v-for="(item,index) in demandas" v-if="(index + 1) > (numero_periodos - no_periodos_calcular)">
                                    ( P.{{index + 1}} * <span>{{ponderacion[index - (numero_periodos - no_periodos_calcular)]}}</span> )
                                    <span v-if="index+1 < demandas.length">+ </span>
                                    </span> ) / {{no_periodos_calcular}}
                                </label>
                                <p class="mt-4">Resultado:</p>
                                <label class="block LetraFinal tracking-wide text-grey-darker font-bold mb-2 mt-3">
                                    ( <span v-for="(item,index) in demandas" v-if="(index + 1) > (numero_periodos - no_periodos_calcular)">
                                        <span v-if="item !== null">
                                            ( {{item}} * <span>{{ponderacion[index - (numero_periodos - no_periodos_calcular)]}}</span> )
                                        </span>
                                        <span v-else>0</span>
                                        <span v-if="index+1 < demandas.length">+ </span>
                                    </span> ) = <span v-bind:class="{ 'text-red-700' : Resultado === 'Datos incompletos' , 'text-blue-700' : Resultado !== 'Datos incompletos' }">{{Resultado}}</span>
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
        name: "PromedioMovilPonderado",
        components: {
            AppLayout,
        },
        data() {
            return {
                numero_periodos: null,
                no_periodos_calcular: null,
                demandas: [],
                ponderacion: [],
                resultado: null
            }
        },
        computed:{
            Resultado: function(){

                var _this = this;

                if(this.numero_periodos && this.no_periodos_calcular){
                    var ultimas_demandas = this.demandas.slice(Math.max(this.demandas.length - this.no_periodos_calcular, 1));

                    var suma = 0;
                    ultimas_demandas.forEach( function(valor, indice, array) {

                        if(valor !== null){
                            suma = parseFloat(suma) + (parseFloat(valor) * parseFloat(_this.ponderacion[indice]) );
                        }
                    });
                    var resultado = suma;

                }else {
                    var resultado = 0;
                }

                if (isNaN(resultado)) {
                    return 'Datos incompletos';
                }
                return resultado;
            }
        },
        methods:{
            ActivarCampo(index){
                if(this.no_periodos_calcular && (index + 1) > (this.numero_periodos - this.no_periodos_calcular) ){
                    return true;
                }else{
                    return false
                }
            },
            CrearCampos(){

                this.demandas = [];

                var campo = null;

                for(var i=1; i<= this.numero_periodos; i++){
                    this.demandas.push(campo);
                }
            },
            CrearPonderacion(){

                this.ponderacion = [];

                var campo = null;

                for(var i=1; i<= this.no_periodos_calcular; i++){
                    this.ponderacion.push(campo);
                }
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