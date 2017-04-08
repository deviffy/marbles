<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 mt-30">
                <div class="panel panel-default">
                    <div class="panel-heading">Buckets</div>

                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <li v-for="(bucket, index) in buckets" class="mt-10">
                                <div class="d-inline-block">Bucket {{ index + 1 }}:</div>
                                <div v-for="marble in bucket" class="d-inline-block">
                                    <div>
                                        <div v-for="n in marble.value" class="marble" v-bind:style="{ 'background-color': marble.code }"><div class="glass"></div><span class="caption">{{ marble.name }}</span></div>
                                    </div>
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
