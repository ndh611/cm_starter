<!-- BEGIN: Signup Form Manual Code from Benchmark Email Ver 2.0 ------>
<script type="text/javascript">
function CheckField215514(fldName, frm){ if ( frm[fldName].length ) { for ( var i = 0, l = frm[fldName].length; i < l; i++ ) {  if ( frm[fldName].type =='select-one' ) { if ( frm[fldName][i].selected ) { return true; } }  else { if ( frm[fldName][i].checked ) { return true; } }; } return false; } else { if ( frm[fldName].type == "checkbox" ) { return ( frm[fldName].checked ); } else if ( frm[fldName].type == "radio" ) { return ( frm[fldName].checked ); } else { frm[fldName].focus(); return (frm[fldName].value.length > 0); }} }
function rmspaces(x) {var leftx = 0;var rightx = x.length -1;while ( x.charAt(leftx) == ' ') { leftx++; }while ( x.charAt(rightx) == ' ') { --rightx; }var q = x.substr(leftx,rightx-leftx + 1);if ( (leftx == x.length) && (rightx == -1) ) { q =''; } return(q); }
function checkfield(data) {if (rmspaces(data) == ""){return false;}else {return true;}}
function isemail(data) {var flag = false;if (  data.indexOf("@",0)  == -1 || data.indexOf("\\",0)  != -1 ||data.indexOf("/",0)  != -1 ||!checkfield(data) ||  data.indexOf(".",0)  == -1  ||  data.indexOf("@")  == 0 ||data.lastIndexOf(".") < data.lastIndexOf("@") ||data.lastIndexOf(".") == (data.length - 1)   ||data.lastIndexOf("@") !=   data.indexOf("@") ||data.indexOf(",",0)  != -1 ||data.indexOf(":",0)  != -1 ||data.indexOf(";",0)  != -1  ) {return flag;} else {var temp = rmspaces(data);if (temp.indexOf(' ',0) != -1) { flag = true; }var d3 = temp.lastIndexOf('.') + 4;var d4 = temp.substring(0,d3);var e2 = temp.length  -  temp.lastIndexOf('.')  - 1;var i1 = temp.indexOf('@');if (  (temp.charAt(i1+1) == '.') || ( e2 < 1 ) ) { flag = true; }return !flag;}}
function CheckFieldD215514(fldH, chkDD, chkMM, chkYY, reqd, frm){ var retVal = true; var dt = validDate215514(chkDD, chkMM, chkYY, frm); var nDate = frm[chkDD].value  + " " + frm[chkMM].value + " " + frm[chkYY].value; if ( dt == null && reqd == 1 ) {	nDate = ""; retVal = false;	} else if ( (frm[chkDD].value != "" || frm[chkMM].value != "" || frm[chkYY].value != "") && dt == null) { retVal = false; nDate = "";} if ( retVal ) {frm[fldH].value = nDate;} return retVal; }
function validDate215514(chkDD, chkMM, chkYY, frm) {var objDate = null;	if ( frm[chkDD].value != "" && frm[chkMM].value != "" && frm[chkYY].value != "" ) {var mSeconds = (new Date(frm[chkYY].value - 0, frm[chkMM].selectedIndex - 1, frm[chkDD].value - 0)).getTime();var objDate = new Date();objDate.setTime(mSeconds);if (objDate.getFullYear() != frm[chkYY].value - 0 || objDate.getMonth()  != frm[chkMM].selectedIndex - 1  || objDate.getDate() != frm[chkDD].value - 0){objDate = null;}}return objDate;}
function _checkSubmit215514(frm){
if ( !isemail(frm["fldEmail"].value) ) { 
   alert("Please enter the Email");
   return false;
}
 return true; }
</script>

<form style="display:inline;" action="http://lb.benchmarkemail.com//code/lbform" method=post name="frmLB215514" accept-charset="UTF-8" onsubmit="return _checkSubmit215514(this);" >

	<input type=hidden name=successurl value="http://www.benchmarkemail.com/Code/ThankYouOptin?" />
	<input type=hidden name=errorurl value="http://lb.benchmarkemail.com//Code/Error" />
	<input type=hidden name=token value="mFcQnoBFKMTVBiuz5%2Bs%2F2OZXUawFafLC0Fko6XAaTK83Ih4P1WxctQ%3D%3D" />
	<input type=hidden name=doubleoptin value="" />

	<div class=bmform_outer215514 id=tblFormData215514>
		<div class=bmform_inner215514>
			<div class=bmform_head215514 id=tdHeader215514>
				<div class=bm_headetext215514>
					<h3><?php _e( 'Join Our Mailing List','CM Starter' ); ?></h3>
				</div>
			</div>
			
			<div class=bmform_body215514>
				<div id=tblFieldData215514>
					<div class=bmform_frmtext215514><strong><?php _e( 'Email','CM Starter' ); ?></strong></div>
					<input type=text class=bmform_frm215514 name=fldEmail maxlength=100 />
				</div>

				<div class=bmform_button215514>
					<input type="submit" id="btnSubmit" value="OK"  krydebug="1751" class=bmform_submit215514 />
				</div>
			</div>
			<div class=bmform_footer215514>
				<div class=footer_bdy215514>
					<div class=footer_txt215514></div>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- END: Signup Form Manual Code from Benchmark Email Ver 2.0 ------>