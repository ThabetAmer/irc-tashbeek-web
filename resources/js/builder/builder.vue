<template>
  <div>
    <div class="container">
      <div class="row mt-12 mb-12">
        <div class="col-md-12">
          <Panel
            :has-title="hasTitle"
            title="Table"
          >
            <Datatable />
          </Panel>
        </div>
      </div>
      <div class="row mt-12">
        <div class="col-md-6">
          <Panel
            :has-title="hasTitle"
            title="Recent Activity / Notes Box"
          >
            <Notebox />
            <Notebox />
            <Notebox />
          </Panel>
        </div>

        <div class="col-md-6">
          <Panel
            :has-title="hasTitle"
            title="Job Opening"
          >
            <JobOpening />
            <JobOpening />
            <JobOpening />
          </Panel>
        </div>
      </div>
      <div
        class="row mb-12 mt-12"
        style=""
      >
        <div class="col-md-4">
          <Panel>
            <h3>TEST</h3>
          </Panel>
        </div>
      </div>


      <div class="row mb-8">
        <div class="col-md-3">
          <MetricCard
            :icon-class="'fas fa-calendar-alt'"
            :value="'11'"
            :label="'Pending Follow Ups'"
          />
        </div>

        <div class="col-md-3">
          <MetricCard
            :icon-class="'fas fa-briefcase'"
            :value="'11'"
            :label="'Firm Intakes'"
          />
        </div>


        <div class="col-md-3">
          <MetricCard
            :icon-class="'fas fa-plus'"
            :value="'11'"
            :label="'Current Jobs'"
          />
        </div>
      </div>

      <div class="row mb-8">
        <div class="col-md-8">
          <Panel
            has-title="true"
            title="Recent Activity"
          />
        </div>
      </div>

      <div class="row mb-8">
        <div class="col-md-4">
          <Btn
            :theme="'primary'"
            :btn-class="'mb-2'"
            @btn-click="btnClickNote"
          >
            <template slot="text">
              Show Note
            </template>
          </Btn>
        </div>
      </div>
      <div
        class="row"
        style="margin-bottom: 30px ;"
      >
        <div class="col-md-6">
          <h3>buttons</h3>
          <Btn
            :theme="'primary'"
            :btn-class="'mb-2'"
            @btn-click="btnClick"
          >
            <template slot="text">
              Primary
            </template>
          </Btn>

          <Btn
            :theme="'default'"
            :btn-class="'mb-2'"
            @btn-click="btnClick"
          >
            <template slot="text">
              Default
            </template>
          </Btn>

          <Btn
            :theme="'success'"
            :btn-class="'mb-2'"
            @btn-click="btnClick"
          >
            <template slot="text">
              Success
            </template>
          </Btn>

          <Btn
            :theme="'danger'"

            :btn-class="'mb-2'"
            @btn-click="btnClick"
          >
            <template slot="text">
              Failure
            </template>
          </Btn>
        </div>

        <div class="col-md-6">
          <h3>links</h3>
          <AnchorLink
            link-ref="/"
            :theme="'primary'"
            :btn-class="'mr-2'"
          >
            <template slot="text">
              Primary Link
            </template>
          </AnchorLink>

          <AnchorLink
            link-ref="/"
            :theme="'default'"
            :btn-class="'mr-2'"
          >
            <template slot="text">
              Default Link
            </template>
          </AnchorLink>


          <AnchorLink
            link-ref="/"
            :theme="'success'"
            :btn-class="'mr-2'"
          >
            <template slot="text">
              Success Link
            </template>
          </AnchorLink>

          <AnchorLink
            link-ref="/"
            :theme="'danger'"
            :btn-class="'mr-2'"
          >
            <template slot="text">
              Failure Link
            </template>
          </AnchorLink>
        </div>
      </div>

      <div
        style="margin-bottom: 30px"
        class="row"
      >
        <div class="col-md-2 offset-md-2">
          <h3>Select</h3>
          <CustomSelect
            v-model="value"
            :label="'name'"
            :options="SelectOptions"
            track-by="name"
            @select="handleSelect"
          />

          <pre style="margin-top: 10px">{{ value }}</pre>
        </div>


        <div class="col-md-2 offset-md-4">
          <h3>Multi Select</h3>
          <CustomSelect
            v-model="mulValue"
            :label="'name'"
            :options="SelectOptions"
            track-by="name"
            :multiple="mulProp"
            @select="handleSelectMul"
          />

          <pre style="margin-top: 10px">{{ mulValue }}</pre>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <h3>Button Group</h3>
          <ButtonGroup>
            <Btn
              :theme="'primary'"
              :btn-class="'mb-2'"
              @btn-click="btnClick"
            >
              <template slot="text">
                Primary
              </template>
            </Btn>
            <Btn
              :theme="'danger'"
              :btn-class="'mb-2'"
              @btn-click="btnClick"
            >
              <template slot="text">
                Failure
              </template>
            </Btn>
          </ButtonGroup>
        </div>

        <div class="col-md-6">
          <h3>Checkbox</h3>
          <Checkbox
            :label="'Single Checkbox'"
            :value="singleCheck"
            :checked="checked"
            @input="checkboxChange"
          />
          <pre style="width: 20%;margin: 15px auto;">{{ checked }}
                </pre>
        </div>
      </div>


      <div
        class="row"
        style="margin-top: 20px"
      >
        <div class="col-md-6">
          <h3>Checkbox Group</h3>
          <CheckboxGroup
            :checkboxes="checkboxes"
            @change="multipleChanged"
          />
          <pre style="width: 20%;margin: 15px auto;">{{ multipleCheckboxvalues }}
                </pre>
        </div>
      </div>
    </div>
    <Modal
      v-if="showModal"
      @close="showModal = false"
    >
      <h3 slot="header">
        Modal Header
      </h3>

      <div
        slot="body"
        class="row"
      >
        <div class="col-md-6">
          <img
            src="https://picsum.photos/500/300/?random"
            alt=""
          >
        </div>
        <div class="col-md-6">
          <img
            src="https://picsum.photos/500/300/?random"
            alt=""
          >
        </div>
      </div>

      <Btn
        slot="footer"
        :theme="'danger'"
        :btn-class="'mb-2'"
        @btn-click="showModal = false"
      >
        <template slot="text">
          Close
        </template>
      </Btn>
    </Modal>


    <AddNoteModal
      :show-modal="showModalNote"
    />
  </div>
</template>


<script>
    import Vue from 'vue';
    import btn from '../components/button/button'
    import AnchorLink from '../components/link/link'
    import CustomSelect from '../components/select/select'
    import modal from '../components/modal/modal'
    import addNoteModal from '../components/modal/addNoteModal'
    import buttonGroup from '../components/buttonGroup/buttonGroup'
    import checkbox from '../components/checkbox/checkbox'
    import checkboxGroup from '../components/checkboxGroup/checkbox-group'
    import Panel from '../components/Panel/Panel'
    import MetricCard from '../components/MetricCard/MetricCard'
    import notebox from '../components/notebox/notebox'
    import jobOpening from '../components/jobOpening/jobOpening'
    import datatable from '../components/datatable/datatable'

    export default {
        components: {
            btn, AnchorLink,
            CustomSelect, modal, buttonGroup,
            checkbox, checkboxGroup, Panel, MetricCard,
            addNoteModal, notebox, jobOpening, datatable
        },
        filters: {},
        props: {},
        data() {
            return {
                checkboxes: [
                    {
                        value: 'Ahamd',
                        label: 'Ahmad'
                    },
                    {
                        value: 'Noor',
                        label: 'Ali'
                    }
                ],
                hasTitle: true,
                multipleCheckboxvalues: [],
                singleCheck: 'Ahmad',
                checked: false,
                SelectOptions: [
                    {name: 'Vue.js', language: 'JavaScript'},
                    {name: 'Rails', language: 'Ruby'},
                    {name: 'Sinatra', language: 'Ruby'},
                    {name: 'Laravel', language: 'PHP'},
                    {name: 'Phoenix', language: 'Elixir'}
                ],
                value: '',
                showModal: false,
                showModalNote: false,
                mulValue: [],
                mulProp: true,

            }
        },
        computed: {},
        watch: {},
        created() {
        },
        mounted() {

        },
        methods: {
            multipleChanged(values) {
                console.log('multiple change is ', values);
                this.multipleCheckboxvalues = values;
            },
            checkboxChange(change) {
                console.log('change is ', change);
                this.checked = change;
            },
            btnClickNote() {
                this.showModalNote = true;
            },
            btnClick() {
                console.log(' btn has been clicked');
                this.showModal = true;
            },
            handleSelect(selected) {
                console.log('selected is ', selected);
                this.value = selected;
            },
            handleSelectMul(selected) {
                console.log('selected is ', selected);
                // this.value = selected;
            }
        }
    }
</script>