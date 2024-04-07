<template>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <template v-for="modul in moduls">
            <div v-if="modul.actiu == 1" class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ modul.codi }} - {{ modul.sigles }}</h5>
                        <p class="card-text">{{ modul.nom }}</p>
                        <button type="button" class="btn btn-success" @click="showForm()">Modificar rúbrica</button>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <div class="modal" tabindex="-1" id="rubricaModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <template v-for="(resultat,index) in resultats">
                        <div class="mb-3">
                            <h3 class="form-label">{{ resultat.descripcio }}</h3>
                            <template v-for="(criteri,index2) in resultat.criteris">
                                <label class="mt-3">{{ criteri.descripcio }}</label>
                                <select class="form-select" v-model="selectedValues[index + '-' + index2]">
                                    <template v-for="rubrica in criteri.rubriques">
                                        <option v-bind:value="rubrica.nivell">{{ rubrica.descripcio }}</option>
                                    </template>
                                </select>
                            </template>
                        </div>
                    </template>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" aria-label="Save" @click="saveRubrica()">Guardar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="loader" class="load container-fluid hide">
        <div class="loader"></div>
    </div>

</template>
<script>

import * as bootstrap from 'bootstrap'

export default {

    data(){
        return {
            moduls: [],
            resultats: [],
            myModal: {},
            rubricas: {},
            datos: {},
            selectedValues: []
        }
    },
    created(){
        this.listarModulos();
    },
    methods:{
        saveRubrica(){

            const me = this;
            const riderId = document.querySelector('meta[name="userId"]').content
            let notas = new Array();
            let cont1 = 0;
            let cont2 = 0;

            for (let resultat of this.resultats) {

                for (let criteri of resultat.criteris) {
                    const key = `${cont1}-${cont2}`;
                    if (!this.selectedValues[key]) {
                        this.selectedValues[key] = 0
                    }
                    cont2++;
                    notas.push(this.selectedValues[key]);
                }
                cont1++;
            }

            // this.rubricas.usuari_id = riderId;
            this.rubricas.notas = notas;

            axios
            .put(`modificar-criteris/${riderId}`, me.rubricas)
            .then(response => {


            })
            .catch(error => {

            })

        },
        showForm(){

            const me = this;

            let loader = document.getElementById('loader');
            loader.classList.remove('hide')

            axios
            .get(`rubricas`)
            .then(response => {

                loader.classList.add('hide')
                me.resultats = response.data;

                me.myModal = new bootstrap.Modal('#rubricaModal');
                me.myModal.show();
            })
            .catch(error => {

            })
        },
        listarModulos(){

            const me = this;
            const riderId = document.querySelector('meta[name="userId"]').content

            axios
            .get(`lista-moduls/${riderId}`)
            .then(response => {
                me.moduls = response.data;
            })
            .catch(error => {

            })

        }
    }
};
</script>
<style>

.hide{
    display: none !important;
}

.load{
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    backdrop-filter: brightness(0.5);
    display: flex;
    flex-wrap: nowrap;
    justify-content: center;
    align-items: center;
}

.loader {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.modal-dialog{
    max-width: 80%;
}

.form-label{
    text-decoration: underline;
}

label{
    font-weight: 700;
}

</style>
