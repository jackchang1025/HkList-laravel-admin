import{a as F,E as I,d as C,b as U,c as x,i as N,j as B,e as R}from"./element-plus@2.7.7_vue@3.4.32_typescript@5.5.3_-BPm-_N_9.js";import{i as $,a as h}from"./index-BCRs1Pzi.js";import{f as A}from"./favicon-BrYC5Vmz.js";import{u as H}from"./vue-router@4.4.0_vue@3.4.32_typescript@5.5.3_-ByijA4Eg.js";import{d as j,c as b,i as e,H as o,o as c,a as u,L as f,K as y,F as D,Y as K,Z as O}from"./@vue_runtime-core@3.4.32-BofAHbgu.js";import{r as d,u as S}from"./@vue_reactivity@3.4.32-DksAu7zd.js";import{L as T}from"./@vue_shared@3.4.32-CaCWPAm8.js";import{_ as Y}from"./_plugin-vue_export-helper-DlAUqK2U.js";import"./@vue_runtime-dom@3.4.32-DNdjNMzo.js";import"./lodash-es@4.17.21-BB-zMWwC.js";import"./async-validator@4.2.5-DKvM95Vc.js";import"./@vueuse_core@9.13.0_vue@3.4.32_typescript@5.5.3_-DkVRVfGD.js";import"./@vueuse_shared@9.13.0_vue@3.4.32_typescript@5.5.3_-BbpdFR9m.js";import"./dayjs@1.11.11-Ct2Knyoi.js";import"./@element-plus_icons-vue@2.3.1_vue@3.4.32_typescript@5.5.3_-x2o2c_8n.js";import"./@sxzz_popperjs-es@2.11.7-D9SI2xQl.js";import"./normalize-wheel-es@1.2.0-B6fDCfyv.js";import"./@ctrl_tinycolor@3.6.1-r5W6hzzQ.js";import"./pinia@2.1.7_typescript@5.5.3_vue@3.4.32_typescript@5.5.3_-BSzeUtha.js";import"./vue-demi@0.14.8_vue@3.4.32_typescript@5.5.3_-Dq6ymT-8.js";import"./axios@1.7.2-B4uVmeYG.js";const Z=r=>$.post("/install",r),z=r=>(K("data-v-c77698d2"),r=r(),O(),r),G={class:"container"},J=["src"],P={key:0},W=z(()=>u("p",null,"您的后台登录账号密码均为:admin,请及时登录修改!",-1)),X=j({__name:"InstallView",setup(r){const a=d({db_connection:"mysql",db_host:"localhost",db_port:"3306",db_database:"94list-laravel",db_username:"94list-laravel",db_password:"",app_name:"94list-laravel"}),v=d(null),L={db_connection:[{required:!0,message:"请选择安装方式",trigger:"change"}],db_host:[{required:!0,message:"请输入MySQL 数据库地址",trigger:"blur"}],db_port:[{required:!0,message:"请输入MySQL 端口",trigger:"blur"}],db_database:[{required:!0,message:"请输入MySQL 数据库名",trigger:"blur"}],db_username:[{required:!0,message:"请输入MySQL 用户名",trigger:"blur"}],app_name:[{required:!0,message:"请输入网站名称",trigger:"blur"}]},m=d(!1),p=d(!1),w=async i=>{if(!(!i||!await i.validate()))try{m.value=!0,await Z(a.value),I.success("安装成功!"),p.value=!0}finally{m.value=!1}},g=H(),M=()=>g.push("/"),Q=()=>g.push("/login");return(i,l)=>{const _=C,n=U,s=x,V=N,q=B,E=R,k=F;return c(),b("div",G,[e(k,null,{default:o(()=>[u("h1",null,[u("img",{src:S(A),alt:"logo"},null,8,J)]),u("h2",null,"安装 | "+T(S(h)()),1),p.value?(c(),b("h3",P,[W,e(_,{type:"primary",onClick:l[0]||(l[0]=t=>M())},{default:o(()=>[f("访问首页")]),_:1}),e(_,{type:"success",onClick:l[1]||(l[1]=t=>Q())},{default:o(()=>[f("访问后台")]),_:1})])):y("",!0),e(E,{ref_key:"installFormRef",ref:v,model:a.value,rules:L,disabled:p.value,"label-width":"auto"},{default:o(()=>[e(s,{label:"网站名称",prop:"app_name"},{default:o(()=>[e(n,{modelValue:a.value.app_name,"onUpdate:modelValue":l[2]||(l[2]=t=>a.value.app_name=t)},null,8,["modelValue"])]),_:1}),e(s,{label:"数据库驱动",prop:"db_connection"},{default:o(()=>[e(q,{modelValue:a.value.db_connection,"onUpdate:modelValue":l[3]||(l[3]=t=>a.value.db_connection=t),placeholder:"请选择数据库驱动"},{default:o(()=>[e(V,{label:"MySQL",value:"mysql"}),e(V,{label:"SQLite",value:"sqlite"})]),_:1},8,["modelValue"])]),_:1}),a.value.db_connection==="mysql"?(c(),b(D,{key:0},[e(s,{label:"MySQL 数据库地址",prop:"db_host"},{default:o(()=>[e(n,{modelValue:a.value.db_host,"onUpdate:modelValue":l[4]||(l[4]=t=>a.value.db_host=t)},null,8,["modelValue"])]),_:1}),e(s,{label:"MySQL 端口",prop:"db_port"},{default:o(()=>[e(n,{modelValue:a.value.db_port,"onUpdate:modelValue":l[5]||(l[5]=t=>a.value.db_port=t)},null,8,["modelValue"])]),_:1}),e(s,{label:"MySQL 数据库名",prop:"db_database"},{default:o(()=>[e(n,{modelValue:a.value.db_database,"onUpdate:modelValue":l[6]||(l[6]=t=>a.value.db_database=t)},null,8,["modelValue"])]),_:1}),e(s,{label:"MySQL 用户名",prop:"db_username"},{default:o(()=>[e(n,{modelValue:a.value.db_username,"onUpdate:modelValue":l[7]||(l[7]=t=>a.value.db_username=t)},null,8,["modelValue"])]),_:1}),e(s,{label:"MySQL 密码",prop:"db_password"},{default:o(()=>[e(n,{modelValue:a.value.db_password,"onUpdate:modelValue":l[8]||(l[8]=t=>a.value.db_password=t)},null,8,["modelValue"])]),_:1})],64)):y("",!0),e(s,{class:"center"},{default:o(()=>[e(_,{type:"primary",onClick:l[9]||(l[9]=t=>w(v.value)),loading:m.value},{default:o(()=>[f(" 安装 ")]),_:1},8,["loading"])]),_:1})]),_:1},8,["model","disabled"])]),_:1})])}}}),Se=Y(X,[["__scopeId","data-v-c77698d2"]]);export{Se as default};
