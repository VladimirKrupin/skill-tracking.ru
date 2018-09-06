<template>
    <div>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Отправка файлов для займа</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Выберите файлы
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div style="
                                    position: fixed;
                                    width: 100%;height: 100%;
                                    background: rgba(0,0,0,.7);
                                    left: 0;
                                    top: 0;
                                    z-index: 10000;
                                    display: flex;
                                    display: none;
                                    align-items: center;
                                    justify-content: center">

                                        <div style="width: 500px;height: 500px">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    Загрузка файла
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label>Выберите файл</label>
                                                                <input type="file">
                                                            </div>
                                                            <textarea style="resize: none; width: 100%" class="form-control" rows="3" placeholder="Перетащите файл в эту область"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form style="display: none" role="form">
                                        <div class="form-group">
                                            <div class="file" style="display: flex;align-content: center">
                                                <span style="width: 150px">Паспортные данные</span>
                                                <span style="width: 150px;margin-left:10px;">
                                                    <p class="fa fa-plus-circle"></p>
                                                </span>
                                            </div>
                                            <div class="file" style="display: flex;align-content: center">
                                                <span style="width: 150px;">Кредитная история</span>
                                                <span style="width: 150px;margin-left:10px;">
                                                    <p class="fa fa-plus-circle"></p>
                                                </span>
                                            </div>
                                            <div class="file" style="display: flex;align-content: center">
                                                <span style="width: 150px">Отчет по финансам</span>
                                                <span style="width: 150px;margin-left:10px;">
                                                    <p class="fa fa-plus-circle"></p>
                                                </span>
                                            </div>
                                            <div class="file" style="display: flex;align-content: center">
                                                <span style="width: 150px">Данные поручителей</span>
                                                <span style="width: 150px;margin-left:10px;">
                                                    <p class="fa fa-plus-circle"></p>
                                                </span>
                                            </div>
                                            <div class="file" style="display: flex;align-content: center">
                                                <span style="width: 150px">Данные МВД</span>
                                                <span style="width: 150px;margin-left:10px;">
                                                    <p class="fa fa-plus-circle"></p>
                                                </span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Загрузить файлы</button>
                                    </form>
                                    <form role="form">
                                        <div class="form-group">
                                            <div class="file" style="display: flex;align-content: center">
                                                <span style="width: 150px">Паспортные данные</span>
                                                <span style="color: #2ebb62;">passport_data.doc</span>
                                                <p class="fa ok"></p>
                                            </div>
                                            <div class="file" style="display: flex;align-content: center">
                                                <span style="width: 150px;color: #bb465b;">Кредитная история</span>
                                                <span style="color: #bb465b;">credit_story.doc</span>
                                                <span style="width: 50px;margin-left:10px;">
                                                    <p class="fa fa-plus-circle"></p>
                                                </span>
                                                <span style="color: #bb465b;">Не одобрено, загрузите другой файл</span>
                                            </div>
                                            <div class="file" style="display: flex;align-content: center">
                                                <span style="width: 150px">Отчет по финансам</span>
                                                <span style="width: 150px;margin-left:10px;">
                                                    <p class="fa fa-plus-circle"></p>
                                                </span>
                                            </div>
                                            <div class="file" style="display: flex;align-content: center">
                                                <span style="width: 150px">Данные поручителей</span>
                                                <span style="width: 150px;margin-left:10px;">
                                                    <p class="fa fa-plus-circle"></p>
                                                </span>
                                            </div>
                                            <div class="file" style="display: flex;align-content: center">
                                                <span style="width: 150px">Данные МВД</span>
                                                <span style="color: #2ebb62;">mvd_data.doc</span>
                                                <p class="fa ok"></p>
                                            </div>
                                        </div>
                                        <button @click="podioConnect" class="btn btn-primary">Загрузить файлы</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
    </div>
</template>
<style>
    p {
        margin-bottom: 0;
    }
    .file {
        margin-bottom: 10px;
    }
    .ok {
        /*background: url("ok.png");*/
        width: 15px;
        height: 15px;
        background-size: contain;
        margin-left: 10px;
    }
</style>
<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                info: '123'
            };
        },
        methods: {
            podioConnect: function (event) {
                event.preventDefault();
                let headers = {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('id_token')
                };
                let data = {
                    email: '',
                    password: ''
                };
                const options = {
                    method: 'POST',
                    headers: headers,
                    data: data,
                    url: '/api/podioConnect',
                };
                axios(options)
                    .then(response => {
                    })
                    .catch(e => {
                    });
            }
        }
    }
</script>