<template>
    
    <div style="margin: 0; padding: 0;">
        
        <div class='botones-tabla'>
            <div class='contenedor-botones-tabla' v-for="(botontabla, index) in botonestoptabla" :key="`botontabla-${index}`"  v-html=botontabla></div>
        </div>           
        
        <div class="container-fluid" style="overflow-x: auto; margin-top: 2em; min-height:85vh;">
            
            <p style="text-align: right; font-size: 0.8em; margin: 0; padding: 0;"> {{name}} </p>
            <table id="tableCrudTableComponent" class="table table-striped">
                
                <thead class="table-primary">
                    <tr>
                        <th><input class="input_filtro form-control" placeholder="#" v-on:keyup="filtrarTabla($event, 0)"> </th>
                        <th v-for="(column, index) of columns" :key='`botontabla-${index}`'>
                            <input :title="[[ column ]]" class="input_filtro form-control" :placeholder="[[ column ]]" v-on:keyup="filtrarTabla($event, index+1 )">
                        </th>
                        <th v-for="(data, key1) in botonesporelemento" :key="`botonesporelemento-${key1}`">
                            
                            <i v-if="key1 == 0" class="material-icons" title="Quitar Filtros" v-on:click="eliminarFiltros()">filter_list</i>
                            
                        </th>                        
                        
                    </tr>
                </thead>

                <tbody id="cuerpo_tabla_crudTableComponent">
                    <tr class="" v-if="tableData.length === 0">
                        <td class="lead text-center" :colspan="columns.length + 1">No hay {{name}}</td>
                    </tr>
                    
                    <tr v-else v-for="(data, key0) in tableData" :key="data.id" class="m-datatable__row" >
                        
                        <td>{{ serialNumber(key0) }}</td>
                        <td v-for="(value, key1) in data" :key="`columna-${key1}`">{{ value }}</td>
                        
                        <td v-for="(boton, key2) in botonesdetodosloselementos[key0]" v-html="boton" :key="key2"></td>
                            
                        
                    </tr>
                    
                    
                </tbody>              
                
            </table>

        </div>  
        
        
    </div>
   
</template>

<script>
    export default {
        props: {
            fetchUrl: {type: String, required: true},
            columns: {type: Array, required: true},
            name: {type: String, required: true},
            botonestoptabla: {type: Array, required: false},
            botonesporelemento: {type: Array, required: false},
        },
        data() {
            return {
                datos: "",
                tableData: [],
                botonesdetodosloselementos: []
            }
        },
        created() {
           
            return this.fetchData(this.fetchUrl);
            
        },
        methods: {
            fetchData(url) {
                
                
                axios.get(url, {
                        headers: {
                        'Authorization': `Bearer ${localStorage.getItem("token_auth_api")}`
                        }
                    }).then(data => {
                            
                            //console.log(data.data);
                            if(data.data.length == 0){
                                console.log("No hay datos para generar la CrudTable " + url);
                                return;
                            }

                            this.tableData = data.data
                            
                            //Al traer los datos, lo primero que debemos validar
                            //Es que la cantidad de datos por elemento
                            //Sea igual a la cantidad de columnas.
                            if( data.data[0].length  <  this.columns.length ){
                                alert("La cantidad de datos es menor al número de columnas. Columnas: " + this.columns.length + " datos: " + data.data[0].length);
                            }
                            
                            this.enlazarDatosAbotonesPorElemento();
                        })
            },
            /**
             * Get the serial number.
             * @param key
             * */
            serialNumber(key) {
                return key + 1;
            },
            
            enlazarDatosAbotonesPorElemento(){
                
                let datos_elemento = this.tableData;
                if(null == datos_elemento || typeof(datos_elemento) == "undefined"){
                    alert("Error obteniendo los datos de cada registro, recarga la página");
                    return;
                }
                
                
                //por cada elemento, se va a crear sus respectivos botones y se va a enlazar la información del elemento
                for(var m = 0; m < datos_elemento.length; m++){
                    
                    let botonesdelelementoactual = [];
                    
                    //Por cada botón de los elementos, enlazamos los datos de su respectivo elemento
                    for(var i = 0; i < this.botonesporelemento.length; i++){

                        let boton = this.botonesporelemento[i].split(" ");

                        //Cada elemento de la columna va a ser un data- del botón con el fin de pasar todos
                        //los datos al model y poder operar.
                        let datosUsuarioHTML = "";
                        for(var k = 0; k < this.columns.length; k++){

                            let nombre_columna_actual = this.columns[k].replace(/\s+/g, '').toLowerCase();

                            datosUsuarioHTML += "data-" + nombre_columna_actual + "=" + "'"+ datos_elemento[m][k] +"' ";
                        }
                        
                        //splice(index, The number of items to be removed, )
                        boton.splice(1, 0, datosUsuarioHTML);

                        

                        this.botonesporelemento[i] = "";
                        for(var j = 0; j < boton.length; j++){
                            this.botonesporelemento[i] += boton[j]+" ";
                        }  
                        
                        botonesdelelementoactual.push( this.botonesporelemento[i] );
                    }
                    
                    this.botonesdetodosloselementos.push(botonesdelelementoactual);

                }
            },
            
            filtrarTabla(event, indexColumnaFiltrar){
                
                let valorAfiltrar = event.target.value;
                let indexFilaAocultar = 1;//empezamos desde 1, porque nth-child empieza desde 1
                //obtenemos todas la columna de la tabla en la posición indexColumnaFiltrar
                //buscamos en esos registros el valor valorAfiltrar, sino lo tiene, ocultamos la fila número indexColumnaFiltrar
                
                //Primero por cada fila (tr):
                $("#tableCrudTableComponent tbody tr").each( function(index){

                   

                    //ahora obtenemos la columna con el index indexColumnaFiltrar y verificamos si esa columna NO tiene
                    //ese valorAfiltrar, en ese caso ocultamos la fila número indexColumnaFiltrar
                   
                    //Si la fila tiene el atributo display: none, es porque ya se había filtrado por lo tanto se debe ignorar.
                    
                    if( $(this)[0].style.display != "none"){
                        
                        if( !$(this).children()[indexColumnaFiltrar].innerText.toLowerCase().includes(valorAfiltrar.toLowerCase()) ){

                            $("#tableCrudTableComponent tbody tr:nth-child("+indexFilaAocultar+")").hide();

                        }else{
                            $("#tableCrudTableComponent tbody tr:nth-child("+indexFilaAocultar+")").show();
                        }                        
                    }

                    
                    indexFilaAocultar++;
                });
            },
            
            eliminarFiltros(){
                
                let indexFilaAmostrar = 1;
                $("#tableCrudTableComponent tbody tr").each( function(index){
                    $("#tableCrudTableComponent tbody tr:nth-child("+indexFilaAmostrar+")").show(1000);
                
                    indexFilaAmostrar++;
                });
                
            }
            
        },
        filters: {
            columnHead(value) {
                return value.split('_').join(' ').toUpperCase()
            }
        },
        name: 'CrudTable'
    }
    
</script>

<style scoped>
    
    .botones-tabla{
        position: fixed;
        height: 2em;
        width: 60%; left: 25%;
        text-align: center;
        padding: 0;
        display: block; 
        top: 4em;
    }
    
    .contenedor-botones-tabla{
           display: inline;
           box-sizing: border-box;
           padding: 0;
           margin: 0;
    }
    
    thead{
        
        width: 100% important;
        
    }
    
    .input_filtro{
        width: 100%;
    }
    
</style>