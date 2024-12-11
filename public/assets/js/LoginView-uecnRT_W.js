import{a as F,v as k,E as R,b as x,c as B,d as C,e as $}from"./element-plus@2.7.7_vue@3.4.32_typescript@5.5.3_-BPm-_N_9.js";import{c as _}from"./@vue_runtime-dom@3.4.32-DNdjNMzo.js";import{g as I,a as N,l as K,s as S,b as q}from"./index--MJ3Ntw9.js";import{f as D}from"./favicon-BrYC5Vmz.js";import{u as U}from"./vue-router@4.4.0_vue@3.4.32_typescript@5.5.3_-ByijA4Eg.js";import{d as A,c as G,I as H,G as M,H as s,o as g,a as d,i as o,L as v}from"./@vue_runtime-core@3.4.32-BofAHbgu.js";import{r as f,u as w}from"./@vue_reactivity@3.4.32-DksAu7zd.js";import{L as T}from"./@vue_shared@3.4.32-CaCWPAm8.js";import{_ as h}from"./_plugin-vue_export-helper-DlAUqK2U.js";import"./lodash-es@4.17.21-BB-zMWwC.js";import"./async-validator@4.2.5-DKvM95Vc.js";import"./@vueuse_core@9.13.0_vue@3.4.32_typescript@5.5.3_-DkVRVfGD.js";import"./@vueuse_shared@9.13.0_vue@3.4.32_typescript@5.5.3_-BbpdFR9m.js";import"./dayjs@1.11.11-Ct2Knyoi.js";import"./@element-plus_icons-vue@2.3.1_vue@3.4.32_typescript@5.5.3_-x2o2c_8n.js";import"./@sxzz_popperjs-es@2.11.7-D9SI2xQl.js";import"./normalize-wheel-es@1.2.0-B6fDCfyv.js";import"./@ctrl_tinycolor@3.6.1-r5W6hzzQ.js";import"./pinia@2.1.7_typescript@5.5.3_vue@3.4.32_typescript@5.5.3_-BSzeUtha.js";import"./vue-demi@0.14.8_vue@3.4.32_typescript@5.5.3_-Dq6ymT-8.js";import"./axios@1.7.2-B4uVmeYG.js";const j={class:"container"},z=["src"],J=A({__name:"LoginView",setup(O){const n=U();I()==="1"&&n.push("/admin");const y=()=>n.push("/register"),i=f(!1),t=f({username:"",password:""}),l=f(null),V={username:[{required:!0,message:"请输入用户名",trigger:"blur"}],password:[{required:!0,message:"请输入密码",trigger:"blur"}]},m=async u=>{if(!(!u||!await u.validate()))try{i.value=!0;const e=await K({username:t.value.username,password:t.value.password});R.success("登陆成功"),S("1");const a=e.data.role;q(a),n.push(`/${a}`)}finally{i.value=!1}};return(u,e)=>{const a=x,p=B,c=C,b=$,L=F,E=k;return g(),G("div",j,[H((g(),M(L,null,{default:s(()=>[d("h1",null,[d("img",{src:w(D),alt:"logo"},null,8,z)]),d("h2",null,"登陆 | "+T(w(N)()),1),o(b,{ref_key:"loginFormRef",ref:l,model:t.value,rules:V,"label-width":"auto"},{default:s(()=>[o(p,{label:"用户名",prop:"username"},{default:s(()=>[o(a,{modelValue:t.value.username,"onUpdate:modelValue":e[0]||(e[0]=r=>t.value.username=r),onKeyup:e[1]||(e[1]=_(r=>m(l.value),["enter"]))},null,8,["modelValue"])]),_:1}),o(p,{label:"密码",prop:"password"},{default:s(()=>[o(a,{modelValue:t.value.password,"onUpdate:modelValue":e[2]||(e[2]=r=>t.value.password=r),type:"password",onKeyup:e[3]||(e[3]=_(r=>m(l.value),["enter"]))},null,8,["modelValue"])]),_:1}),o(p,{class:"center"},{default:s(()=>[o(c,{type:"primary",onClick:e[4]||(e[4]=r=>y())},{default:s(()=>[v("注册")]),_:1}),o(c,{type:"primary",onClick:e[5]||(e[5]=r=>m(l.value))},{default:s(()=>[v("登陆")]),_:1})]),_:1})]),_:1},8,["model"])]),_:1})),[[E,i.value]])])}}}),_e=h(J,[["__scopeId","data-v-76f977eb"]]);export{_e as default};