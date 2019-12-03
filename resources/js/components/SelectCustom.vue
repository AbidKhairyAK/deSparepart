<template>
	<vue-select :name="name" 
		:settings="setting" 
		required 
		:value="value" 
		@change="updateSelect"
		ref="select"
	>
	</vue-select>
</template>

<script>
		import VueSelect from 'v-select2-component';

		export default {
				components: {'vue-select': VueSelect},
				props: ['name', 'api', 'value', 'pre_value', 'pre_text'],
				data: () => ({
					selected: null,
				}),
				computed: {
					setting() {
						return {
							ajax: {
								url: this.api,
								data: function (params) {
									return {
										search: params.term,
									}
								},
								processResults: function (data) {
									return {
										results: data.map((item) => {
											return {
													text: item.name,
													id: item.id
											}
										})
									};
								}
							}
						}
					}
				},
				methods: {
					updateSelect(val) {
			      this.selected = val;
			      this.$emit('input', val );
			    },
			    testPreselected() {
			    	if (this.pre_value && this.pre_text) {
    		    	this.$refs.select.select2
    			    .append(
    			      $(`<option selected value="${this.pre_value}">${this.pre_text}</option>`)
    			    )
    			    .trigger('change');
			    	}
			    }
				},
				mounted() {
					this.testPreselected();
			    this.selected = this.pre_value;
				},
				updated() {
					this.testPreselected();
				}
		}
</script>
