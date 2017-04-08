<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 mt-30">
                <div class="panel panel-default">
                    <div class="panel-heading">Setup 2/2 - Remaining marbles: {{ remainingMarbles }}</div>

                    <div class="panel-body">
                        <form>
                            <div v-for="color in colorSet" class="row form-group">
                                <label for="input" class="col-sm-6 control-label">How many {{ color }} marbles are there?</label>
                                <div class="col-sm-6">
                                    <input type="number" name="marbles" id="marbles" class="form-control" value="" min="0" max="" step="1" required="required" v-model="marbleSet[color]" v-on:change="updateCounter">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-12 text-right">
                                    <button type="button" class="btn btn-primary" :disabled="valid === false" v-on:click="setMarbles">Submit</button>
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
                buckets: [],
                colorSet: [],
                marbleSet: {},
                usedMarbles: 0,
                valid: false
            }
        },
        computed: {
            remainingMarbles: function () {
                return this.colorSet.length * this.colorSet.length - this.usedMarbles;
            }
        },
        mounted: function () {
            this.colorSet = this.$parent.colorSet;
        },
        methods: {
            updateCounter: function (event) {
                var counter = 0;
                var max = this.colorSet.length * this.colorSet.length;

                for (var property in this.marbleSet) {
                    if (this.marbleSet.hasOwnProperty(property)) {
                        counter += Number(this.marbleSet[property]);
                    }
                }

                if (counter > max) {
                    counter = max;
                    alert('You have exceeded the number of marbles available.');
                }

                this.usedMarbles = counter;

                if (counter == max) {
                    this.valid = true;
                }
            },
            setMarbles: function (event) {
                axios.post('/api/pickMarbles', { colors: this.colorSet, marbles: this.marbleSet })
                    .then((response) => {
                        console.log(response.data);
                        this.buckets = response.data;
                        this.$parent.showBuckets(this.buckets);
                    })
                    .catch((response) => {
                        console.log(response);
                    });
            }
        }
    }
</script>
