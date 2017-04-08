<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-30">
                <div class="panel panel-default">
                    <div class="panel-heading">Buckets</div>

                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <li v-for="(bucket, index) in buckets" class="bucket row mt-10">
                                <div class="col-xs-12">
                                    <span v-for="marble in bucket" class="d-inline-block">
                                        <div v-for="n in marble.value" class="marble" v-bind:style="{ 'background-color': marble.code }"><div class="glass"></div><span class="caption">{{ marble.name }}</span></div>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    module.exports = {
        data: function () {
            return {
                buckets: [],
                test: '#000'
            }
        },
        mounted: function () {
            this.buckets = this.$parent.buckets;
        },
    }
</script>
