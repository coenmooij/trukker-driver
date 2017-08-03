<template>

    <div class="register">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center">
                    <p class="bold">
                        Trukker is een online platform waar transportbedrijven open diensten aan kunnen bieden. Chauffeurs kunnen zelf reageren op diensten.
                        <br>
                        <br>
                        Zelf bepalen voor welk tarief en op welke momenten je wilt werken!
                        <br>
                    </p>
                    <hr>

                </div>
                <form v-if="!signedUp">
                    <div class="form-group">
                        <label for="first-name">Voornaam</label>
                        <input class="form-control" id="first-name" type="text" v-model="firstName">
                    </div>
                    <div class="form-group">
                        <label for="last-name">Achternaam</label>
                        <input class="form-control" id="last-name" type="text" v-model="lastName">
                    </div>
                    <div class="form-group">
                        <label for="email">Emailadres</label>
                        <input class="form-control" id="email" type="text" v-model="email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefoonnummer</label>
                        <input class="form-control" id="phone" type="text" v-model="phone">
                    </div>
                    <div class="form-group">
                        <label for="freelancer">Ben je freelancer?</label>
                        <select class="form-control" name="freelancer" id="freelancer" v-model="freelancer">
                            <option value="no">Nee</option>
                            <option value="maybe">Ik overweeg het</option>
                            <option value="yes">Ja</option>
                        </select>

                    </div>
                    <div class="divider"></div>
                    <button type="submit" class="btn btn-success pull-right" @click.prevent="signUp">
                        <span class="glyphicon glyphicon-check"></span> Inschrijven
                    </button>
                    <div class="clearfix"></div>
                </form>
                <div class="alert alert-success text-center" v-if="signedUp && !allEmpty">
                    <h3>Inschrijving gelukt!</h3>
                    <p>We nemen snel contact met je op.</p>
                    <hr>
                    <button class="btn btn-primary" @click="reset">
                        <span class="glyphicon glyphicon-check"></span> Schrijf nog iemand in
                    </button>
                </div>
                <div class="alert alert-danger text-center" v-if="signedUp && allEmpty">
                    <h3>Inschrijving niet gelukt!</h3>
                    <p>Vul aub het formulier zo volledig mogelijk in.</p>
                    <hr>
                    <button class="btn btn-danger" @click="signedUp = false">
                        <span class="glyphicon glyphicon-repeat"></span> Probeer nogmaals
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                signedUp: false,
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                freelancer: 'no',
            }
        },
        computed: {
            allEmpty(){
                return this.firstName === ''
                    && this.lastName === ''
                    && this.email === ''
                    && this.phone === '';
            },
        },
        methods: {
            signUp(){
                if (!this.allEmpty) {
                    this.$http.post('signup.php', {
                        firstName: this.firstName,
                        lastName: this.lastName,
                        email: this.email,
                        phone: this.phone,
                        freelancer: this.freelancer,
                    }).then(
                        (res) => console.log(res.body)
                    ).catch(
                        (error) => console.log(error)
                    );
                }
                this.signedUp = true;
            },
            reset(){
                this.firstName = '';
                this.lastName = '';
                this.email = '';
                this.phone = '';
                this.freelancer = 'no';
                this.signedUp = false;
            },
        },
    }
</script>

<style scoped>
    h4 {
        line-height: 1.7em;
    }

    .logo {
        padding: 30px;
    }

    .bold {
        font-weight: bold;
    }

    button {
        width: 100%;
    }

    form {
        padding: 10px;
    }
</style>
