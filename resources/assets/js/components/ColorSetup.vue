<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 mt-30">
                <div class="panel panel-default">
                    <div class="panel-heading">Setup 1/2</div>

                    <div class="panel-body">
                        <form>
                            <div class="row form-group">
                                <label for="input" class="col-sm-6 control-label">How many different colors do you want?</label>
                                <div class="col-sm-6">
                                    <input type="number" name="colors" id="colors" class="form-control" value="" min="0" max="50" step="1" required="required" v-model="colors">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-12 text-right">
                                    <button type="button" class="btn btn-primary" v-on:click="setColors">Submit</button>
                                </div>
                            </div>
                        </form>
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
                colors: 0,
                colorSet: []
            }
        },
        methods: {
            setColors: function (event) {
                axios.post('/api/pickColors', {count: this.colors})
                    .then((response) => {
                        this.colorSet = response.data;
                        this.$parent.setMarbles(this.colorSet);
                    })
                    .catch((response) => {
                        console.log(response);
                    });
            }
        }
    }
</script>
