<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Clientes - <small>Editar</small></h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 p-2">
                        <router-link
                            :to="{ name: 'clientes.index' }"
                            class="btn btn-primary btn-block btn-flat"
                            ><i class="fa fa-arrow-left"></i>
                            Volver</router-link
                        >
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-green">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3
                                            class="card-title text-center w-full"
                                        >
                                            <i class="fas fa-edit"></i>
                                            Editar Registro
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger': errors.file_nro,
                                            }"
                                            >File Nro.*</label
                                        >
                                        <el-input
                                            placeholder="File Nro."
                                            :class="{
                                                'is-invalid': errors.file_nro,
                                            }"
                                            v-model="oCliente.file_nro"
                                            @keypress.enter.native="
                                                enviaRegistro
                                            "
                                            clearable
                                            maxlength="200"
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.file_nro"
                                            v-text="errors.file_nro[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.tipo_embarque_id,
                                            }"
                                            >Tipo de Embarque*</label
                                        >
                                        <el-select
                                            filterable
                                            class="w-100 d-block"
                                            :class="{
                                                'is-invalid':
                                                    errors.tipo_embarque_id,
                                            }"
                                            v-model="oCliente.tipo_embarque_id"
                                            clearable
                                        >
                                            <el-option
                                                v-for="item in listTipoEmbarques"
                                                :key="item.id"
                                                :value="item.id"
                                                :label="item.nombre"
                                            >
                                            </el-option>
                                        </el-select>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.tipo_embarque_id"
                                            v-text="errors.tipo_embarque_id[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger': errors.venta,
                                            }"
                                            >Venta*</label
                                        >
                                        <el-input
                                            placeholder="Venta"
                                            :class="{
                                                'is-invalid': errors.venta,
                                            }"
                                            v-model="oCliente.venta"
                                            @keypress.enter.native="
                                                enviaRegistro
                                            "
                                            clearable
                                            maxlength="200"
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.venta"
                                            v-text="errors.venta[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.oficina_id,
                                            }"
                                            >Oficina*</label
                                        >
                                        <el-select
                                            filterable
                                            class="w-100 d-block"
                                            :class="{
                                                'is-invalid': errors.oficina_id,
                                            }"
                                            v-model="oCliente.oficina_id"
                                            clearable
                                        >
                                            <el-option
                                                v-for="item in listOficinas"
                                                :key="item.id"
                                                :value="item.id"
                                                :label="item.nombre"
                                            >
                                            </el-option>
                                        </el-select>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.oficina_id"
                                            v-text="errors.oficina_id[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger': errors.venta,
                                            }"
                                            >Cliente*</label
                                        >
                                        <el-input
                                            placeholder="Cliente"
                                            :class="{
                                                'is-invalid': errors.cliente,
                                            }"
                                            v-model="oCliente.cliente"
                                            @keypress.enter.native="
                                                enviaRegistro
                                            "
                                            clearable
                                            maxlength="200"
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.cliente"
                                            v-text="errors.cliente[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger': errors.cnee,
                                            }"
                                            >Cnee*</label
                                        >
                                        <el-input
                                            placeholder="Cnee"
                                            :class="{
                                                'is-invalid': errors.cnee,
                                            }"
                                            v-model="oCliente.cnee"
                                            @keypress.enter.native="
                                                enviaRegistro
                                            "
                                            clearable
                                            maxlength="200"
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.cnee"
                                            v-text="errors.cnee[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger': errors.contacto,
                                            }"
                                            >Contacto*</label
                                        >
                                        <el-input
                                            placeholder="Contacto"
                                            :class="{
                                                'is-invalid': errors.contacto,
                                            }"
                                            v-model="oCliente.contacto"
                                            @keypress.enter.native="
                                                enviaRegistro
                                            "
                                            clearable
                                            maxlength="200"
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.contacto"
                                            v-text="errors.contacto[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger': errors.dir,
                                            }"
                                            >Dirección*</label
                                        >
                                        <el-input
                                            placeholder="Dirección"
                                            :class="{
                                                'is-invalid': errors.dir,
                                            }"
                                            v-model="oCliente.dir"
                                            @keypress.enter.native="
                                                enviaRegistro
                                            "
                                            clearable
                                            maxlength="200"
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.dir"
                                            v-text="errors.dir[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger': errors.ciudad,
                                            }"
                                            >Ciudad*</label
                                        >
                                        <el-input
                                            placeholder="Ciudad"
                                            :class="{
                                                'is-invalid': errors.ciudad,
                                            }"
                                            v-model="oCliente.ciudad"
                                            @keypress.enter.native="
                                                enviaRegistro
                                            "
                                            clearable
                                            maxlength="200"
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.ciudad"
                                            v-text="errors.ciudad[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger': errors.fono,
                                            }"
                                            >Teléfono*</label
                                        >
                                        <el-input
                                            placeholder="Teléfono"
                                            :class="{
                                                'is-invalid': errors.fono,
                                            }"
                                            v-model="oCliente.fono"
                                            @keypress.enter.native="
                                                enviaRegistro
                                            "
                                            clearable
                                            maxlength="200"
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.fono"
                                            v-text="errors.fono[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger': errors.fax,
                                            }"
                                            >Fax*</label
                                        >
                                        <el-input
                                            placeholder="Fax"
                                            :class="{
                                                'is-invalid': errors.fax,
                                            }"
                                            v-model="oCliente.fax"
                                            @keypress.enter.native="
                                                enviaRegistro
                                            "
                                            clearable
                                            maxlength="200"
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.fax"
                                            v-text="errors.fax[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger': errors.nro_nit,
                                            }"
                                            >Nro. Nit*</label
                                        >
                                        <el-input
                                            placeholder="Nro. Nit"
                                            :class="{
                                                'is-invalid': errors.nro_nit,
                                            }"
                                            v-model="oCliente.nro_nit"
                                            @keypress.enter.native="
                                                enviaRegistro
                                            "
                                            clearable
                                            maxlength="200"
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.nro_nit"
                                            v-text="errors.nro_nit[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger': errors.master,
                                            }"
                                            >Master*</label
                                        >
                                        <el-input
                                            placeholder="Master"
                                            :class="{
                                                'is-invalid': errors.master,
                                            }"
                                            v-model="oCliente.master"
                                            @keypress.enter.native="
                                                enviaRegistro
                                            "
                                            clearable
                                            maxlength="200"
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.master"
                                            v-text="errors.master[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger': errors.house,
                                            }"
                                            >House*</label
                                        >
                                        <el-input
                                            placeholder="House"
                                            :class="{
                                                'is-invalid': errors.house,
                                            }"
                                            v-model="oCliente.house"
                                            @keypress.enter.native="
                                                enviaRegistro
                                            "
                                            clearable
                                            maxlength="200"
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.house"
                                            v-text="errors.house[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.documentos_cp,
                                            }"
                                            >Documentos Contra Pago*</label
                                        >
                                        <el-switch
                                            :class="{
                                                'is-invalid':
                                                    errors.documentos_cp,
                                            }"
                                            style="display: block"
                                            v-model="oCliente.documentos_cp"
                                            active-color="#13ce66"
                                            inactive-color="#dcdfe6"
                                            active-text="SI"
                                            inactive-text="NO"
                                            active-value="SI"
                                            inactive-value="NO"
                                        >
                                            >
                                        </el-switch>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.documentos_cp"
                                            v-text="errors.documentos_cp[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.hbl_ai_cnee_fletado,
                                            }"
                                            >HBL AI CNEE Fletado*</label
                                        >
                                        <el-switch
                                            :class="{
                                                'is-invalid':
                                                    errors.hbl_ai_cnee_fletado,
                                            }"
                                            style="display: block"
                                            v-model="
                                                oCliente.hbl_ai_cnee_fletado
                                            "
                                            active-color="#13ce66"
                                            inactive-color="#dcdfe6"
                                            active-text="SI"
                                            inactive-text="NO"
                                            active-value="SI"
                                            inactive-value="NO"
                                        >
                                            >
                                        </el-switch>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.hbl_ai_cnee_fletado"
                                            v-text="
                                                errors.hbl_ai_cnee_fletado[0]
                                            "
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.flete_menor,
                                            }"
                                            >Flete Menor*</label
                                        >
                                        <el-switch
                                            :class="{
                                                'is-invalid':
                                                    errors.flete_menor,
                                            }"
                                            style="display: block"
                                            v-model="oCliente.flete_menor"
                                            active-color="#13ce66"
                                            inactive-color="#dcdfe6"
                                            active-text="SI"
                                            inactive-text="NO"
                                            active-value="SI"
                                            inactive-value="NO"
                                        >
                                            >
                                        </el-switch>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.flete_menor"
                                            v-text="errors.flete_menor[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger': errors.cuanto,
                                            }"
                                            >Cuanto*</label
                                        >
                                        <el-switch
                                            :class="{
                                                'is-invalid': errors.cuanto,
                                            }"
                                            style="display: block"
                                            v-model="oCliente.cuanto"
                                            active-color="#13ce66"
                                            inactive-color="#dcdfe6"
                                            active-text="SI"
                                            inactive-text="NO"
                                            active-value="SI"
                                            inactive-value="NO"
                                        >
                                            >
                                        </el-switch>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.cuanto"
                                            v-text="errors.cuanto[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.puerto_embarque,
                                            }"
                                            >Puerto Embarque*</label
                                        >
                                        <el-input
                                            placeholder="Puerto Embarque"
                                            :class="{
                                                'is-invalid':
                                                    errors.puerto_embarque,
                                            }"
                                            v-model="oCliente.puerto_embarque"
                                            @keypress.enter.native="
                                                enviaRegistro
                                            "
                                            clearable
                                            maxlength="200"
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.puerto_embarque"
                                            v-text="errors.puerto_embarque[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.puerto_destino_id,
                                            }"
                                            >Puerto Destino*</label
                                        >
                                        <el-select
                                            filterable
                                            class="w-100 d-block"
                                            :class="{
                                                'is-invalid':
                                                    errors.puerto_destino_id,
                                            }"
                                            v-model="oCliente.puerto_destino_id"
                                            clearable
                                        >
                                            <el-option
                                                v-for="item in listPuertoDestinos"
                                                :key="item.id"
                                                :value="item.id"
                                                :label="item.nombre"
                                            >
                                            </el-option>
                                        </el-select>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.puerto_destino_id"
                                            v-text="errors.puerto_destino_id[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.destino_final_id,
                                            }"
                                            >Destino Final*</label
                                        >
                                        <el-select
                                            filterable
                                            class="w-100 d-block"
                                            :class="{
                                                'is-invalid':
                                                    errors.destino_final_id,
                                            }"
                                            v-model="oCliente.destino_final_id"
                                            clearable
                                        >
                                            <el-option
                                                v-for="item in listDestinoFinals"
                                                :key="item.id"
                                                :value="item.id"
                                                :label="item.nombre"
                                            >
                                            </el-option>
                                        </el-select>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.destino_final_id"
                                            v-text="errors.destino_final_id[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger': errors.etd,
                                            }"
                                            >ETD*</label
                                        >
                                        <input
                                            type="date"
                                            @keypress.enter="enviaRegistro"
                                            v-model="oCliente.etd"
                                            :class="{
                                                'is-invalid': errors.etd,
                                            }"
                                            class="form-control"
                                        />
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.etd"
                                            v-text="errors.etd[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger': errors.eta,
                                            }"
                                            >ETA*</label
                                        >
                                        <input
                                            type="date"
                                            @keypress.enter="enviaRegistro"
                                            v-model="oCliente.eta"
                                            :class="{
                                                'is-invalid': errors.eta,
                                            }"
                                            class="form-control"
                                        />
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.eta"
                                            v-text="errors.eta[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.nro_total1,
                                            }"
                                            >Nro. Total*</label
                                        >
                                        <el-input
                                            placeholder="Nro. Total"
                                            :class="{
                                                'is-invalid': errors.nro_total1,
                                            }"
                                            v-model="oCliente.nro_total1"
                                            @keypress.enter.native="
                                                enviaRegistro
                                            "
                                            clearable
                                            maxlength="200"
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.nro_total1"
                                            v-text="errors.nro_total1[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger': errors.units_id1,
                                            }"
                                            >Units*</label
                                        >
                                        <el-select
                                            filterable
                                            class="w-100 d-block"
                                            :class="{
                                                'is-invalid': errors.units_id1,
                                            }"
                                            v-model="oCliente.units_id1"
                                            clearable
                                        >
                                            <el-option
                                                v-for="item in listUnits"
                                                :key="item.id"
                                                :value="item.id"
                                                :label="item.nombre"
                                            >
                                            </el-option>
                                        </el-select>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.units_id1"
                                            v-text="errors.units_id1[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.nro_total2,
                                            }"
                                            >Nro. Total*</label
                                        >
                                        <el-input
                                            placeholder="Nro. Total"
                                            :class="{
                                                'is-invalid': errors.nro_total2,
                                            }"
                                            v-model="oCliente.nro_total2"
                                            @keypress.enter.native="
                                                enviaRegistro
                                            "
                                            clearable
                                            maxlength="200"
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.nro_total2"
                                            v-text="errors.nro_total2[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger': errors.units_id2,
                                            }"
                                            >Units*</label
                                        >
                                        <el-select
                                            filterable
                                            class="w-100 d-block"
                                            :class="{
                                                'is-invalid': errors.units_id2,
                                            }"
                                            v-model="oCliente.units_id2"
                                            clearable
                                        >
                                            <el-option
                                                v-for="item in listUnits"
                                                :key="item.id"
                                                :value="item.id"
                                                :label="item.nombre"
                                            >
                                            </el-option>
                                        </el-select>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.units_id2"
                                            v-text="errors.units_id2[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.socio_proveedor_id,
                                            }"
                                            >Socio/Proveedor*</label
                                        >
                                        <el-select
                                            filterable
                                            class="w-100 d-block"
                                            :class="{
                                                'is-invalid':
                                                    errors.socio_proveedor_id,
                                            }"
                                            v-model="
                                                oCliente.socio_proveedor_id
                                            "
                                            clearable
                                        >
                                            <el-option
                                                v-for="item in listSocioProovedors"
                                                :key="item.id"
                                                :value="item.id"
                                                :label="item.nombre"
                                            >
                                            </el-option>
                                        </el-select>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.socio_proveedor_id"
                                            v-text="
                                                errors.socio_proveedor_id[0]
                                            "
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.embarcado_id,
                                            }"
                                            >Embarcado con*</label
                                        >
                                        <el-select
                                            filterable
                                            class="w-100 d-block"
                                            :class="{
                                                'is-invalid':
                                                    errors.embarcado_id,
                                            }"
                                            v-model="oCliente.embarcado_id"
                                            clearable
                                        >
                                            <el-option
                                                v-for="item in listEmbarcados"
                                                :key="item.id"
                                                :value="item.id"
                                                :label="item.nombre"
                                            >
                                            </el-option>
                                        </el-select>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.embarcado_id"
                                            v-text="errors.embarcado_id[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.flete_master,
                                            }"
                                            >Flete Master*</label
                                        >
                                        <el-select
                                            filterable
                                            class="w-100 d-block"
                                            :class="{
                                                'is-invalid':
                                                    errors.flete_master,
                                            }"
                                            v-model="oCliente.flete_master"
                                            clearable
                                        >
                                            <el-option
                                                v-for="item in listFleteMaster"
                                                :key="item"
                                                :value="item"
                                                :label="item"
                                            >
                                            </el-option>
                                        </el-select>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.flete_master"
                                            v-text="errors.flete_master[0]"
                                        ></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label
                                            :class="{
                                                'text-danger':
                                                    errors.flete_house,
                                            }"
                                            >Flete House*</label
                                        >
                                        <el-select
                                            filterable
                                            class="w-100 d-block"
                                            :class="{
                                                'is-invalid':
                                                    errors.flete_house,
                                            }"
                                            v-model="oCliente.flete_house"
                                            clearable
                                        >
                                            <el-option
                                                v-for="item in listFleteHouse"
                                                :key="item"
                                                :value="item"
                                                :label="item"
                                            >
                                            </el-option>
                                        </el-select>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.flete_house"
                                            v-text="errors.flete_house[0]"
                                        ></span>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label
                                            :class="{
                                                'text-danger': errors.notas,
                                            }"
                                            >Notas*</label
                                        >
                                        <el-input
                                            type="textarea"
                                            :autosize="{ minRows: 2 }"
                                            placeholder="Notas"
                                            :class="{
                                                'is-invalid': errors.notas,
                                            }"
                                            v-model="oCliente.notas"
                                            clearable
                                            maxlength="2000"
                                        >
                                        </el-input>
                                        <span
                                            class="error invalid-feedback"
                                            v-if="errors.notas"
                                            v-text="errors.notas[0]"
                                        ></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="bg-green">
                                                    <th
                                                        class="text-center"
                                                        colspan="3"
                                                    >
                                                        EGRESOS
                                                        <button
                                                            class="btn-sm btn-flat btn-primary"
                                                            @click="addEgreso()"
                                                        >
                                                            <i
                                                                class="fa fa-plus"
                                                            ></i>
                                                        </button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template
                                                    v-if="
                                                        listEgresos.length > 0
                                                    "
                                                >
                                                    <tr
                                                        v-for="(
                                                            egreso, index
                                                        ) in listEgresos"
                                                        :key="index"
                                                    >
                                                        <td>
                                                            <el-input
                                                                type="textarea"
                                                                :autosize="{
                                                                    minRows: 2,
                                                                }"
                                                                :class="{
                                                                    'is-invalid':
                                                                        errors[
                                                                            'egresos_desc.' +
                                                                                index
                                                                        ],
                                                                }"
                                                                placeholder="Descripción"
                                                                clearable
                                                                maxlength="2000"
                                                                v-model="
                                                                    egreso.descripcion
                                                                "
                                                            >
                                                            </el-input>
                                                            <span
                                                                class="error invalid-feedback"
                                                                v-if="
                                                                    errors[
                                                                        'egresos_desc.' +
                                                                            index
                                                                    ]
                                                                "
                                                                v-text="
                                                                    errors[
                                                                        'egresos_desc.' +
                                                                            index
                                                                    ][0]
                                                                "
                                                            ></span>
                                                        </td>
                                                        <td>
                                                            <input
                                                                type="number"
                                                                :class="{
                                                                    'is-invalid':
                                                                        errors[
                                                                            'egresos_monto.' +
                                                                                index
                                                                        ],
                                                                }"
                                                                :value="
                                                                    egreso.monto
                                                                "
                                                                min="1"
                                                                step="0.01"
                                                                class="form-control"
                                                                @keyup="
                                                                    enviaEgreso(
                                                                        egreso,
                                                                        $event
                                                                    )
                                                                "
                                                                @change="
                                                                    enviaEgreso(
                                                                        egreso,
                                                                        $event
                                                                    )
                                                                "
                                                            />
                                                            <span
                                                                class="error invalid-feedback"
                                                                v-if="
                                                                    errors[
                                                                        'egresos_monto.' +
                                                                            index
                                                                    ]
                                                                "
                                                                v-text="
                                                                    errors[
                                                                        'egresos_monto.' +
                                                                            index
                                                                    ][0]
                                                                "
                                                            ></span>
                                                        </td>
                                                        <td>
                                                            <button
                                                                class="btn btn-flat btn-bloc btn-danger btn-sm"
                                                                @click="
                                                                    quitaEgreso(
                                                                        index
                                                                    )
                                                                "
                                                            >
                                                                <i
                                                                    class="fa fa-times"
                                                                ></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </template>
                                                <template v-else>
                                                    <tr>
                                                        <td
                                                            colspan="3"
                                                            class="text-gray text-center font-weight-bold"
                                                        >
                                                            SIN REGISTROS
                                                        </td>
                                                    </tr>
                                                </template>
                                                <tr class="bg-green">
                                                    <td
                                                        class="font-weight-bold text-right"
                                                    >
                                                        TOTAL EGRESOS
                                                    </td>
                                                    <td
                                                        class="font-weight-bold text-center"
                                                    >
                                                        {{
                                                            oCliente.total_egresos
                                                        }}
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="bg-green">
                                                    <th
                                                        class="text-center"
                                                        colspan="3"
                                                    >
                                                        INGRESOS
                                                        <button
                                                            class="btn-sm btn-flat btn-primary"
                                                            @click="
                                                                addIngreso()
                                                            "
                                                        >
                                                            <i
                                                                class="fa fa-plus"
                                                            ></i>
                                                        </button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template
                                                    v-if="
                                                        listIngresos.length > 0
                                                    "
                                                >
                                                    <tr
                                                        v-for="(
                                                            ingreso, index
                                                        ) in listIngresos"
                                                        :key="index"
                                                    >
                                                        <td>
                                                            <el-input
                                                                type="textarea"
                                                                :autosize="{
                                                                    minRows: 2,
                                                                }"
                                                                :class="{
                                                                    'is-invalid':
                                                                        errors[
                                                                            'ingresos_desc.' +
                                                                                index
                                                                        ],
                                                                }"
                                                                placeholder="Descripción"
                                                                clearable
                                                                maxlength="2000"
                                                                v-model="
                                                                    ingreso.descripcion
                                                                "
                                                            >
                                                            </el-input>
                                                            <span
                                                                class="error invalid-feedback"
                                                                v-if="
                                                                    errors[
                                                                        'ingresos_desc.' +
                                                                            index
                                                                    ]
                                                                "
                                                                v-text="
                                                                    errors[
                                                                        'ingresos_desc.' +
                                                                            index
                                                                    ][0]
                                                                "
                                                            ></span>
                                                        </td>
                                                        <td>
                                                            <input
                                                                type="number"
                                                                :class="{
                                                                    'is-invalid':
                                                                        errors[
                                                                            'ingresos_monto.' +
                                                                                index
                                                                        ],
                                                                }"
                                                                :value="
                                                                    ingreso.monto
                                                                "
                                                                min="1"
                                                                step="0.01"
                                                                class="form-control"
                                                                @keyup="
                                                                    enviaIngreso(
                                                                        ingreso,
                                                                        $event
                                                                    )
                                                                "
                                                                @change="
                                                                    enviaIngreso(
                                                                        ingreso,
                                                                        $event
                                                                    )
                                                                "
                                                            />
                                                            <span
                                                                class="error invalid-feedback"
                                                                v-if="
                                                                    errors[
                                                                        'ingresos_monto.' +
                                                                            index
                                                                    ]
                                                                "
                                                                v-text="
                                                                    errors[
                                                                        'ingresos_monto.' +
                                                                            index
                                                                    ][0]
                                                                "
                                                            ></span>
                                                        </td>
                                                        <td>
                                                            <button
                                                                class="btn btn-flat btn-bloc btn-danger btn-sm"
                                                                @click="
                                                                    quitaIngreso(
                                                                        index
                                                                    )
                                                                "
                                                            >
                                                                <i
                                                                    class="fa fa-times"
                                                                ></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </template>
                                                <template v-else>
                                                    <tr>
                                                        <td
                                                            colspan="3"
                                                            class="text-gray text-center font-weight-bold"
                                                        >
                                                            SIN REGISTROS
                                                        </td>
                                                    </tr>
                                                </template>
                                                <tr class="bg-green">
                                                    <td
                                                        class="font-weight-bold text-right"
                                                    >
                                                        TOTAL INGRESOS
                                                    </td>
                                                    <td
                                                        class="font-weight-bold text-center"
                                                    >
                                                        {{
                                                            oCliente.total_ingresos
                                                        }}
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6 ml-auto mr-auto">
                                        <label>Profit*:</label>
                                        <div class="form-group">
                                            <input
                                                type="number"
                                                class="form-control"
                                                v-model="oCliente.profit"
                                                readonly
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <el-button
                                            class="btn btn-primary bg-primary btn-flat btn-block"
                                            :loading="enviando"
                                            @click="enviaRegistro()"
                                            ><i class="fa fa-edit"></i>
                                            Actualizar Registro</el-button
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    props: ["id"],
    data() {
        return {
            permisos: localStorage.getItem("permisos"),
            loadingWindow: Loading.service({
                fullscreen: this.fullscreenLoading,
            }),
            oCliente: {
                file_nro: "",
                tipo_embarque_id: "",
                venta: "",
                oficina_id: "",
                cliente: "",
                cnee: "",
                contacto: "",
                dir: "",
                ciudad: "",
                fono: "",
                fax: "",
                nro_nit: "",
                master: "",
                house: "",
                documentos_cp: "",
                hbl_ai_cnee_fletado: "",
                flete_menor: "",
                cuanto: "",
                puerto_embarque: "",
                puerto_destino_id: "",
                destino_final_id: "",
                etd: "",
                eta: "",
                nro_total1: "",
                units_id1: "",
                nro_total2: "",
                units_id2: "",
                socio_proveedor_id: "",
                embarcado_id: "",
                flete_master: "",
                flete_house: "",
                notas: "",
                total_ingresos: "",
                total_egresos: "",
                profit: "",
                fecha_registro: "",
            },
            errors: [],
            listTipoEmbarques: [],
            listOficinas: [],
            listPuertoDestinos: [],
            listDestinoFinals: [],
            listUnits: [],
            listSocioProovedors: [],
            listEmbarcados: [],
            listFleteMaster: ["PREPAID", "COLLECT"],
            listFleteHouse: ["PREPAID", "COLLECT"],
            listIngresos: [],
            listEgresos: [],
            enviando: false,
        };
    },
    mounted() {
        this.getCliente();
        this.getTipoEmbarques();
        this.getOficinas();
        this.getPuertoDestinos();
        this.getDestinoFinals();
        this.getUnits();
        this.getSocioProveedors();
        this.getEmbarcados();
        this.calculaTotales();
        this.loadingWindow.close();
    },
    methods: {
        // OBTENER EL CLIENTE
        getCliente() {
            axios
                .get("/admin/clientes/getCliente/" + this.id)
                .then((response) => {
                    this.oCliente = response.data;
                    this.listEgresos = this.oCliente.cliente_egresos;
                    this.listIngresos = this.oCliente.cliente_ingresos;
                });
        },
        // obtener lista de tipo de embarques
        getTipoEmbarques() {
            axios
                .get("/admin/get_listas/listaTipoEmbarques")
                .then((response) => {
                    this.listTipoEmbarques = response.data;
                });
        },
        // obtener lista de oficinas
        getOficinas() {
            axios.get("/admin/get_listas/listaOificinas").then((response) => {
                this.listOficinas = response.data;
            });
        },
        // obtener lista de destinos
        getPuertoDestinos() {
            axios
                .get("/admin/get_listas/listaPuertosDestinos")
                .then((response) => {
                    this.listPuertoDestinos = response.data;
                });
        },
        // obtener lista de destinos finales
        getDestinoFinals() {
            axios
                .get("/admin/get_listas/listaDestinoFinals")
                .then((response) => {
                    this.listDestinoFinals = response.data;
                });
        },
        // obtener lista de units
        getUnits() {
            axios.get("/admin/get_listas/listaUnits").then((response) => {
                this.listUnits = response.data;
            });
        },
        // obtener lista de socios proveedores
        getSocioProveedors() {
            axios
                .get("/admin/get_listas/listSociosProveedores")
                .then((response) => {
                    this.listSocioProovedors = response.data;
                });
        },
        // obtener lista de socios proveedores
        getEmbarcados() {
            axios.get("/admin/get_listas/listaEmbarcados").then((response) => {
                this.listEmbarcados = response.data;
            });
        },

        // MODIFICA VALORES EGRESOS
        enviaEgreso(item, e) {
            item.monto = parseFloat(e.target.value);
            this.calculaTotalEgresos();
        },
        enviaIngreso(item, e) {
            item.monto = parseFloat(e.target.value);
            this.calculaTotalIngresos();
        },

        // CALCULAR TOTALES
        calculaTotales() {
            this.calculaTotalEgresos();
            this.calculaTotalIngresos();
        },
        calculaTotalEgresos() {
            let suma_total = 0;
            this.oCliente.total_egresos = 0;
            this.listEgresos.forEach((element) => {
                if (element.monto) {
                    suma_total += parseFloat(element.monto);
                }
            });
            this.oCliente.total_egresos = parseFloat(suma_total.toFixed(2));
            this.calculaProfit();
        },
        calculaTotalIngresos() {
            let suma_total = 0;
            this.oCliente.total_ingresos = 0;
            this.listIngresos.forEach((element) => {
                if (element.monto) {
                    suma_total += parseFloat(element.monto);
                }
            });
            this.oCliente.total_ingresos = parseFloat(suma_total.toFixed(2));
            this.calculaProfit();
        },
        calculaProfit() {
            this.oCliente.profit =
                parseFloat(this.oCliente.total_ingresos) -
                parseFloat(this.oCliente.total_egresos);
        },

        // AGREGAR EGRESO
        addEgreso() {
            this.listEgresos.push({ descripcion: "", monto: parseFloat("1") });
            this.calculaTotalEgresos();
        },
        // AGREGAR INGRESO
        addIngreso() {
            this.listIngresos.push({ descripcion: "", monto: parseFloat("1") });
            this.calculaTotalIngresos();
        },
        // QUITA REGISTROS
        quitaEgreso(index) {
            if (!this.listEgresos[index].id) {
                this.listEgresos.splice(index, 1);
                this.calculaTotalEgresos();
            } else {
                Swal.fire({
                    title: "¿Quierés eliminar este registro?",
                    html: `<strong>Esta acción no se podrá deshacer</strong>`,
                    showCancelButton: true,
                    confirmButtonColor: "#05568e",
                    confirmButtonText: "Si, eliminar",
                    cancelButtonText: "No, cancelar",
                    denyButtonText: `No, cancelar`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        let formdata = new FormData();
                        formdata.append("id", this.listEgresos[index].id);
                        formdata.append("tipo", "egreso");
                        formdata.append("_method", "DELETE");
                        axios
                            .post("/admin/clientes/destroy_ei", formdata)
                            .then((response) => {
                                this.oCliente.total_egresos =
                                    response.data.total_egresos;
                                this.oCliente.total_ingresos =
                                    response.data.total_ingresos;
                                this.oCliente.profit = response.data.profit;
                                this.listEgresos.splice(index, 1);
                                this.calculaTotalEgresos();
                            });
                    }
                });
            }
        },
        quitaIngreso(index) {
            if (!this.listIngresos[index].id) {
                this.listIngresos.splice(index, 1);
                this.calculaTotalIngresos();
            } else {
                Swal.fire({
                    title: "¿Quierés eliminar este registro?",
                    html: `<strong>Esta acción no se podrá deshacer</strong>`,
                    showCancelButton: true,
                    confirmButtonColor: "#05568e",
                    confirmButtonText: "Si, eliminar",
                    cancelButtonText: "No, cancelar",
                    denyButtonText: `No, cancelar`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        let formdata = new FormData();
                        formdata.append("id", this.listIngresos[index].id);
                        formdata.append("tipo", "ingreso");
                        formdata.append("_method", "DELETE");
                        axios
                            .post("/admin/clientes/destroy_ei", formdata)
                            .then((response) => {
                                this.oCliente.total_egresos =
                                    response.data.total_egresos;
                                this.oCliente.total_ingresos =
                                    response.data.total_ingresos;
                                this.oCliente.profit = response.data.profit;
                                this.listIngresos.splice(index, 1);
                                this.calculaTotalIngresos();
                            });
                    }
                });
            }
        },
        // ENVIAR FORMULARIO
        enviaRegistro() {
            this.enviando = true;
            try {
                let url = "/admin/clientes/" + this.id;
                let formdata = new FormData();
                formdata.append("_method", "PUT");
                formdata.append("file_nro", this.oCliente.file_nro);
                formdata.append(
                    "tipo_embarque_id",
                    this.oCliente.tipo_embarque_id
                );
                formdata.append("venta", this.oCliente.venta);
                formdata.append("oficina_id", this.oCliente.oficina_id);
                formdata.append("cliente", this.oCliente.cliente);
                formdata.append("cnee", this.oCliente.cnee);
                formdata.append("contacto", this.oCliente.contacto);
                formdata.append("dir", this.oCliente.dir);
                formdata.append("ciudad", this.oCliente.ciudad);
                formdata.append("fono", this.oCliente.fono);
                formdata.append("fax", this.oCliente.fax);
                formdata.append("nro_nit", this.oCliente.nro_nit);
                formdata.append("master", this.oCliente.master);
                formdata.append("house", this.oCliente.house);
                formdata.append("documentos_cp", this.oCliente.documentos_cp);
                formdata.append(
                    "hbl_ai_cnee_fletado",
                    this.oCliente.hbl_ai_cnee_fletado
                );
                formdata.append("flete_menor", this.oCliente.flete_menor);
                formdata.append("cuanto", this.oCliente.cuanto);
                formdata.append(
                    "puerto_embarque",
                    this.oCliente.puerto_embarque
                );
                formdata.append(
                    "puerto_destino_id",
                    this.oCliente.puerto_destino_id
                );
                formdata.append(
                    "destino_final_id",
                    this.oCliente.destino_final_id
                );
                formdata.append("etd", this.oCliente.etd);
                formdata.append("eta", this.oCliente.eta);
                formdata.append("nro_total1", this.oCliente.nro_total1);
                formdata.append("units_id1", this.oCliente.units_id1);
                formdata.append("nro_total2", this.oCliente.nro_total2);
                formdata.append("units_id2", this.oCliente.units_id2);
                formdata.append(
                    "socio_proveedor_id",
                    this.oCliente.socio_proveedor_id
                );
                formdata.append("embarcado_id", this.oCliente.embarcado_id);
                formdata.append("flete_master", this.oCliente.flete_master);
                formdata.append("flete_house", this.oCliente.flete_house);
                formdata.append("notas", this.oCliente.notas);
                formdata.append("total_ingresos", this.oCliente.total_ingresos);
                formdata.append("total_egresos", this.oCliente.total_egresos);
                formdata.append("profit", this.oCliente.profit);

                if (this.listEgresos.length > 0) {
                    this.listEgresos.forEach((element) => {
                        if (element.id) {
                            formdata.append("egresos_existe[]", element.id);
                        } else {
                            formdata.append("egresos_existe[]", 0);
                        }
                        formdata.append("egresos_desc[]", element.descripcion);
                        formdata.append("egresos_monto[]", element.monto);
                    });
                }

                if (this.listIngresos.length > 0) {
                    this.listIngresos.forEach((element) => {
                        if (element.id) {
                            formdata.append("ingresos_existe[]", element.id);
                        } else {
                            formdata.append("ingresos_existe[]", 0);
                        }
                        formdata.append("ingresos_desc[]", element.descripcion);
                        formdata.append("ingresos_monto[]", element.monto);
                    });
                }

                axios
                    .post(url, formdata)
                    .then((res) => {
                        this.enviando = false;
                        Swal.fire({
                            icon: "success",
                            title: res.data.msj,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        this.errors = [];
                        this.$router.push({ name: "clientes.index" });
                    })
                    .catch((error) => {
                        this.enviando = false;
                        if (error.response) {
                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors;
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: error,
                                    showConfirmButton: false,
                                    timer: 2000,
                                });
                            }
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: error,
                                showConfirmButton: false,
                                timer: 2000,
                            });
                        }
                    });
            } catch (e) {
                this.enviando = false;
                console.log(e);
            }
        },
    },
};
</script>

<style></style>
