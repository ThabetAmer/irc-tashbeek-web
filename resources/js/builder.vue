<template>
    <div>
        <div class="row" style="margin-bottom: 30px ;">
            <div class="col-md-6">
                <h3>buttons</h3>
                <btn
                        @btn-click="btnClick"
                        :theme="'primary'"
                        :btnClass="'mb-2'">
                    <template slot="text">
                        Primary
                    </template>
                </btn>

                <btn
                        @btn-click="btnClick"
                        :theme="'default'"
                        :btnClass="'mb-2'">
                    <template slot="text">
                        Default
                    </template>
                </btn>

                <btn
                        @btn-click="btnClick"
                        :theme="'success'"
                        :btnClass="'mb-2'">
                    <template slot="text">
                        Success
                    </template>
                </btn>

                <btn
                        @btn-click="btnClick"

                        :theme="'failure'"
                        :btnClass="'mb-2'">
                    <template slot="text">
                        Failure
                    </template>
                </btn>
            </div>

            <div class="col-md-6">
                <h3>links</h3>
                <AnchorLink
                        linkRef="/"
                        :theme="'primary'"
                        :btnClass="'mr-2'">
                    <template slot="text">
                        Primary Link
                    </template>
                </AnchorLink>

                <AnchorLink
                        linkRef="/"
                        :theme="'default'"
                        :btnClass="'mr-2'">
                    <template slot="text">
                        Default Link
                    </template>
                </AnchorLink>


                <AnchorLink
                        linkRef="/"
                        :theme="'success'"
                        :btnClass="'mr-2'">
                    <template slot="text">
                        Success Link
                    </template>
                </AnchorLink>

                <AnchorLink
                        linkRef="/"
                        :theme="'failure'"
                        :btnClass="'mr-2'">
                    <template slot="text">
                        Failure Link
                    </template>
                </AnchorLink>


            </div>

        </div>

        <div style="margin-bottom: 30px" class="row">

            <div class="col-md-2 offset-md-2">
                <h3>Select</h3>
                <CustomSelect
                        :label="'name'"
                        :options="SelectOptions"
                        track-by="name"
                        :value="value"
                        @select="handleSelect"
                >
                </CustomSelect>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6">
                <h3>Button Group</h3>
                <buttonGroup>
                    <btn
                            @btn-click="btnClick"
                            :theme="'primary'"
                            :btnClass="'mb-2'">
                            <template slot="text">
                                Primary
                            </template>
                    </btn>

                    <btn
                            @btn-click="btnClick"
                            :theme="'failure'"
                            :btnClass="'mb-2'">
                            <template slot="text">
                                Failure
                            </template>
                    </btn>
                </buttonGroup>
            </div>
        </div>

        <modal
                v-if="showModal"
                @close="showModal = false"
        >

            <h3 slot="header">Modal Header</h3>

            <div slot="body" class="row">
                <div class="col-md-6">
                    <img src="https://picsum.photos/500/300/?random" alt="">
                </div>
                <div class="col-md-6">
                    <img src="https://picsum.photos/500/300/?random" alt="">
                </div>
            </div>

            <btn
                    slot="footer"
                    :theme="'failure'"
                    :btnClass="'mb-2'"
                    @btn-click="showModal = false">
                    <template slot="text">
                        Close
                    </template>
            </btn>

        </modal>

    </div>

</template>


<script>
    import Vue from 'vue';
    import btn from './components/button/button'
    import AnchorLink from './components/link/link'
    import CustomSelect from './components/select/select'
    import modal from './components/modal/modal'
    import buttonGroup from './components/buttonGroup/buttonGroup'

    export default {
        components: {btn, AnchorLink, CustomSelect, modal,buttonGroup},
        props: {},
        data() {
            return {
                SelectOptions: [
                    {name: 'Vue.js', language: 'JavaScript'},
                    {name: 'Rails', language: 'Ruby'},
                    {name: 'Sinatra', language: 'Ruby'},
                    {name: 'Laravel', language: 'PHP'},
                    {name: 'Phoenix', language: 'Elixir'}
                ],
                value: '',
                showModal: false
            }
        },
        created() {
        },
        computed: {},
        mounted() {

        },
        methods: {
            btnClick() {
                console.log(' btn has been clicked');
                this.showModal = true;
            },
            handleSelect(selected) {
                console.log('selected is ', selected);
                this.value = selected;
            }
        },
        filters: {},
        watch: {}
    }
</script>