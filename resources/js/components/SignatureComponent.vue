<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Hier unterschreiben</div>
					<div class="card-body">
						<VueSignaturePad
						id="signature"
						width="100%"
						height="220px"
						ref="signaturePad"
						:options="options"
						/>
					</div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
			<div class="col-2 mt-2">
			  <button type="button" class="btn btn-outline-secondary" @click="clear">L&ouml;schen</button>
			</div>
		</div>
    </div>
</template>

<script>
    export default {
        methods : {
			clear() {
			  this.$refs.signaturePad.clearSignature();
			},
			save() {
			  const { isEmpty, data } = this.$refs.signaturePad.saveSignature();

			  return { isEmpty, data };
			}
		},
		
		mounted() {
            console.log('SignaturePad mounted.')
        }
    }
</script>
