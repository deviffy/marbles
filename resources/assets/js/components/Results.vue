<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 mt-30">
                <div class="panel panel-default">
                    <div class="panel-heading">Buckets</div>

                    <div class="panel-body">
                        <ul>
                            <li v-for="bucket in buckets">{{ bucket }}</li>
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
                buckets: []
            }
        },
        mounted: function () {
            this.buckets = this.$parent.buckets;
        },
    }
</script>
