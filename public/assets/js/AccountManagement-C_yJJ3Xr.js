import{E as f,g as ve,c as ee,i as te,j as ae,b as le,e as ne,d as oe,k as ke,v as ue,m as be,q as Ve,r as ge,o as he,u as Ae}from"./element-plus@2.7.7_vue@3.4.32_typescript@5.5.3_-BPm-_N_9.js";import{c as xe}from"./@vue_runtime-dom@3.4.32-DNdjNMzo.js";import{i as x}from"./index-W6fW7aze.js";import{g as se}from"./enterprise-yOAxDhE5.js";import{d as de,_ as Ce,$ as Ue,m as ie,o as u,G as p,H as t,i as a,L as s,I as ce,c as y,F as z,R as I,a as T,K as d}from"./@vue_runtime-core@3.4.32-BofAHbgu.js";import{r as h,u as X}from"./@vue_reactivity@3.4.32-DksAu7zd.js";import{f as Y}from"./format-CyW-QbYa.js";import{L as r}from"./@vue_shared@3.4.32-CaCWPAm8.js";import{_ as $e}from"./_plugin-vue_export-helper-DlAUqK2U.js";import"./lodash-es@4.17.21-BB-zMWwC.js";import"./async-validator@4.2.5-DKvM95Vc.js";import"./@vueuse_core@9.13.0_vue@3.4.32_typescript@5.5.3_-DkVRVfGD.js";import"./@vueuse_shared@9.13.0_vue@3.4.32_typescript@5.5.3_-BbpdFR9m.js";import"./dayjs@1.11.11-Ct2Knyoi.js";import"./@element-plus_icons-vue@2.3.1_vue@3.4.32_typescript@5.5.3_-x2o2c_8n.js";import"./@sxzz_popperjs-es@2.11.7-D9SI2xQl.js";import"./normalize-wheel-es@1.2.0-B6fDCfyv.js";import"./@ctrl_tinycolor@3.6.1-r5W6hzzQ.js";import"./pinia@2.1.7_typescript@5.5.3_vue@3.4.32_typescript@5.5.3_-BSzeUtha.js";import"./vue-demi@0.14.8_vue@3.4.32_typescript@5.5.3_-Dq6ymT-8.js";import"./axios@1.7.2-B4uVmeYG.js";import"./vue-router@4.4.0_vue@3.4.32_typescript@5.5.3_-ByijA4Eg.js";const we=_=>x.post("/admin/account",_),ze=_=>x.get("/admin/account",{params:_}),Se=_=>x.patch(`/admin/account/${_.id}`,_),Ee=_=>x.patch("/admin/account/info",{account_ids:[_.id]}),Le=_=>x.patch("/admin/account/info",{account_ids:_}),Ie=_=>x.delete("/admin/account",{data:{account_ids:[_.id]}}),De=_=>x.delete("/admin/account",{data:{account_ids:_}}),Z=_=>x.patch("/admin/account/switch",_),Be=_=>x.get(`/admin/account/ban?account_id=${_.id}`),Fe=()=>x.patch("/admin/account/ban"),Me=de({__name:"AddAccount",props:{modelValue:{},modelModifiers:{}},emits:Ce(["getAccounts"],["update:modelValue"]),setup(_,{emit:i}){const S=i,U=Ue(_,"modelValue"),$=h(!1),c=h({type:1,cookie:"",enterprise_account_id:null}),V=h(null),R={cookie:[{required:!0,message:"请输入账户信息",trigger:"blur"}],enterprise_account_id:[{required:!1,message:"请选择关联的企业账号",trigger:"change"}]},E=h([]),k=async()=>{try{const A=await se({page:1,size:100,is_active:!0});E.value=A.data.list}catch(A){console.error("获取企业账号列表失败:",A)}};ie(()=>{k()});const q=async A=>{if(!(!A||!await A.validate()))try{$.value=!0,(await we(c.value)).data.have_repeat&&f.info("存在重复的账号,已自动过滤"),f.success("添加成功")}finally{$.value=!1}},K=A=>{S("getAccounts"),A()},P=()=>{U.value=!1,S("getAccounts")};return(A,v)=>{const j=ve,w=ee,C=te,M=ae,D=le,G=ne,N=oe,B=ke,H=ue;return u(),p(B,{title:"添加账号",width:"60%",modelValue:U.value,"onUpdate:modelValue":v[6]||(v[6]=l=>U.value=l),"before-close":K},{footer:t(()=>[a(N,{type:"info",onClick:v[4]||(v[4]=l=>P())},{default:t(()=>[s("取消")]),_:1}),a(N,{type:"primary",onClick:v[5]||(v[5]=l=>q(V.value))},{default:t(()=>[s("添加")]),_:1})]),default:t(()=>[ce((u(),p(G,{ref_key:"addAccountFormRef",ref:V,model:c.value,rules:R,"label-width":"auto"},{default:t(()=>[a(w,{label:"提示"},{default:t(()=>[a(j,null,{default:t(()=>[s("可以使用换行来分割多个账号")]),_:1})]),_:1}),a(w,{label:"账号类型"},{default:t(()=>[a(M,{modelValue:c.value.type,"onUpdate:modelValue":v[0]||(v[0]=l=>c.value.type=l)},{default:t(()=>[a(C,{label:"cookie",value:1}),a(C,{label:"token",value:2}),a(C,{label:"enterprise",value:3})]),_:1},8,["modelValue"])]),_:1}),c.value.type===1||c.value.type===3?(u(),p(w,{key:0,label:"Cookie",prop:"cookie"},{default:t(()=>[a(D,{type:"textarea",modelValue:c.value.cookie,"onUpdate:modelValue":v[1]||(v[1]=l=>c.value.cookie=l)},null,8,["modelValue"])]),_:1})):(u(),p(w,{key:1,label:"refresh_token",prop:"cookie"},{default:t(()=>[a(D,{type:"textarea",modelValue:c.value.cookie,"onUpdate:modelValue":v[2]||(v[2]=l=>c.value.cookie=l)},null,8,["modelValue"])]),_:1})),a(w,{label:"关联企业账号",prop:"enterprise_account_id"},{default:t(()=>[a(M,{modelValue:c.value.enterprise_account_id,"onUpdate:modelValue":v[3]||(v[3]=l=>c.value.enterprise_account_id=l),clearable:"",placeholder:"选择企业账号"},{default:t(()=>[(u(!0),y(z,null,I(E.value,l=>(u(),p(C,{key:l.id,label:l.name,value:l.id},null,8,["label","value"]))),128))]),_:1},8,["modelValue"])]),_:1})]),_:1},8,["model"])),[[H,$.value]])]),_:1},8,["modelValue"])}}}),Ne={class:"toolbar"},Te={class:"action-buttons"},Re={key:0},qe={key:0},Ke={key:0},Pe={key:0},je={key:0},Ge={key:0},He={key:0},Oe={key:0},Je={key:0},Qe={key:0},We={key:0},Xe=de({__name:"AccountManagement",setup(_){const i=h(!1),S=h(15),U=h(1),$=h(),c=h([]),V=h({keyword:"",enterprise_account_id:void 0}),R=()=>{V.value.keyword="",V.value.enterprise_account_id=void 0,E()},E=()=>{U.value=1,k()},k=async()=>{try{i.value=!0;const l=await ze({page:U.value,size:S.value,keyword:V.value.keyword,enterprise_account_id:V.value.enterprise_account_id});l.data.data=l.data.list.map(n=>(n.switch=!!n.switch,n)),$.value=l.data}finally{i.value=!1}},q=async l=>{try{i.value=!0,await Ee(l),f.success("更新账户信息成功")}finally{i.value=!1,await k()}},K=async()=>{try{i.value=!0;const l=c.value.map(n=>n.id);await Le(l),f.success("批量更新账户成功")}finally{i.value=!1,await k()}},P=async l=>{try{i.value=!0,await Ie(l),f.success("删除账户成功")}finally{i.value=!1,await k()}},A=async()=>{try{i.value=!0;const l=c.value.map(n=>n.id);await De(l),f.success("批量删除账户成功")}finally{i.value=!1,await k()}},v=async()=>{try{i.value=!0;const l=c.value.map(n=>n.id);await Z({account_ids:l,switch:1}),f.success("批量启用账户成功")}finally{i.value=!1,await k()}},j=async()=>{try{i.value=!0;const l=c.value.map(n=>n.id);await Z({account_ids:l,switch:0}),f.success("批量禁用账户成功")}finally{i.value=!1,await k()}},w=l=>c.value=l;ie(async()=>{await k(),await H()});const C=h(!1),M=()=>C.value=!C.value,D=async l=>{if(l.edit=!l.edit,l.edit===!1)try{i.value=!0,await Se(l),f.success("修改賬號成功")}finally{i.value=!1,await k()}},G=async()=>{try{i.value=!0,await Fe(),f.success("启用被限速账号成功")}finally{i.value=!1,await k()}},N=async l=>{try{i.value=!0;const n=await Be(l);if(n.data.errno===0){const g=n.data.anti;f.success("获取封禁信息成功"),g.ban_status?(f.success("封禁状态：已封禁"),f.success(`封禁开始时间: ${new Date(parseInt(`${g.start_time}000`)).toLocaleString()}`),f.success(`封禁结束时间: ${new Date(parseInt(`${g.end_time}000`)).toLocaleString()}`),f.success(`已被封禁${g.ban_times}次`),f.success(`封禁原因: ${g.ban_reason}`)):f.success("封禁状态：未封禁")}else n.data.errno===-6?f.warning("获取封禁信息失败,Cookie或AccessToken已过期"):f.warning(`获取封禁信息失败,code:${n.data.errno},msg:${n.data.errmsg}`)}finally{i.value=!1}},B=h([]),H=async()=>{try{const l=await se({page:1,size:100,is_active:!0});B.value=l.data.list}catch(l){console.error("获取企业账号列表失败:",l)}};return(l,n)=>{var J,Q,W;const g=le,O=ee,L=te,F=ae,b=oe,re=ne,m=be,pe=Ve,_e=ge,me=he,fe=Ae,ye=ue;return u(),y(z,null,[a(Me,{onGetAccounts:k,modelValue:C.value,"onUpdate:modelValue":n[0]||(n[0]=e=>C.value=e)},null,8,["modelValue"]),T("div",Ne,[a(re,{inline:!0,model:V.value},{default:t(()=>[a(O,{label:"关键词"},{default:t(()=>[a(g,{modelValue:V.value.keyword,"onUpdate:modelValue":n[1]||(n[1]=e=>V.value.keyword=e),placeholder:"搜索用户名/CID",clearable:"",onKeyup:xe(E,["enter"])},null,8,["modelValue"])]),_:1}),a(O,{label:"关联企业账号"},{default:t(()=>[a(F,{modelValue:V.value.enterprise_account_id,"onUpdate:modelValue":n[2]||(n[2]=e=>V.value.enterprise_account_id=e),clearable:"",placeholder:"选择企业账号",style:{width:"220px"}},{default:t(()=>[(u(!0),y(z,null,I(B.value,e=>(u(),p(L,{key:e.id,label:e.name,value:e.id,style:{width:"220px"}},null,8,["label","value"]))),128))]),_:1},8,["modelValue"])]),_:1}),a(O,null,{default:t(()=>[a(b,{type:"primary",onClick:E},{default:t(()=>[s("搜索")]),_:1}),a(b,{onClick:R},{default:t(()=>[s("重置")]),_:1})]),_:1})]),_:1},8,["model"])]),T("div",Te,[a(b,{type:"primary",onClick:n[3]||(n[3]=e=>k())},{default:t(()=>[s("刷新列表")]),_:1}),a(b,{type:"primary",onClick:n[4]||(n[4]=e=>M())},{default:t(()=>[s("添加账号")]),_:1}),a(b,{type:"primary",disabled:c.value.length<=0,onClick:n[5]||(n[5]=e=>K())},{default:t(()=>[s(" 批量更新信息 ")]),_:1},8,["disabled"]),a(b,{type:"primary",disabled:c.value.length<=0,onClick:n[6]||(n[6]=e=>v())},{default:t(()=>[s(" 批量启用 ")]),_:1},8,["disabled"]),a(b,{type:"primary",disabled:c.value.length<=0,onClick:n[7]||(n[7]=e=>j())},{default:t(()=>[s(" 批量禁用 ")]),_:1},8,["disabled"]),a(b,{type:"danger",disabled:c.value.length<=0,onClick:n[8]||(n[8]=e=>A())},{default:t(()=>[s(" 批量删除 ")]),_:1},8,["disabled"]),a(b,{type:"primary",onClick:n[9]||(n[9]=e=>G())},{default:t(()=>[s("启用被限速的账号")]),_:1})]),ce((u(),p(me,{data:((J=$.value)==null?void 0:J.data)??[],border:"","show-overflow-tooltip":"",class:"table",onSelectionChange:w},{default:t(()=>[a(m,{type:"selection",fixed:"",width:"40"}),a(m,{prop:"id",label:"ID",fixed:""}),a(m,{prop:"baidu_name",label:"百度用户名",width:"150px"},{default:t(({row:e})=>[e.edit?d("",!0):(u(),y("span",Re,r(e.baidu_name),1)),e.edit?(u(),p(g,{key:1,modelValue:e.baidu_name,"onUpdate:modelValue":o=>e.baidu_name=o},null,8,["modelValue","onUpdate:modelValue"])):d("",!0)]),_:1}),a(m,{prop:"today_size",label:"今日解析",width:"150px"},{default:t(({row:e})=>[T("span",null,r(e.today_count)+" ("+r(X(Y)(e.today_size??0))+")",1)]),_:1}),a(m,{prop:"today_size",label:"总共解析",width:"150px"},{default:t(({row:e})=>[T("span",null,r(e.total_count)+" ("+r(X(Y)(e.total_size??0))+")",1)]),_:1}),a(m,{prop:"account_type",label:"账号类型",width:"160px"},{default:t(({row:e})=>[e.edit?d("",!0):(u(),y("span",qe,r(e.account_type),1)),e.edit?(u(),p(F,{key:1,modelValue:e.account_type,"onUpdate:modelValue":o=>e.account_type=o},{default:t(()=>[(u(),y(z,null,I(["cookie","access_token"],o=>a(L,{key:o,value:o},{default:t(()=>[s(r(o),1)]),_:2},1032,["value"])),64))]),_:2},1032,["modelValue","onUpdate:modelValue"])):d("",!0)]),_:1}),a(m,{prop:"cookie",label:"Cookie",width:"150px"},{default:t(({row:e})=>[e.edit?d("",!0):(u(),y("span",Ke,r(e.cookie),1)),e.edit?(u(),p(g,{key:1,modelValue:e.cookie,"onUpdate:modelValue":o=>e.cookie=o},null,8,["modelValue","onUpdate:modelValue"])):d("",!0)]),_:1}),a(m,{prop:"enterprise_account",label:"关联企业账号",width:"200px"},{default:t(({row:e})=>[e.edit?d("",!0):(u(),y("span",Pe,r(e.enterprise_account?`${e.enterprise_account.name}`:"未关联"),1)),e.edit?(u(),p(F,{key:1,modelValue:e.enterprise_account_id,"onUpdate:modelValue":o=>e.enterprise_account_id=o,clearable:"",placeholder:"选择企业账号"},{default:t(()=>[(u(!0),y(z,null,I(B.value,o=>(u(),p(L,{key:o.id,label:o.name,value:o.id},null,8,["label","value"]))),128))]),_:2},1032,["modelValue","onUpdate:modelValue"])):d("",!0)]),_:1}),a(m,{prop:"expired_at",label:"token过期时间",width:"160px"},{default:t(({row:e})=>[s(r(e.expired_at?new Date(e.expired_at).toLocaleString():"非token模式"),1)]),_:1}),a(m,{prop:"vip_type",label:"会员类型",width:"130px"},{default:t(({row:e})=>[e.edit?d("",!0):(u(),y("span",je,r(e.vip_type),1)),e.edit?(u(),p(F,{key:1,modelValue:e.vip_type,"onUpdate:modelValue":o=>e.vip_type=o},{default:t(()=>[(u(),y(z,null,I(["超级会员","假超级会员","普通会员","普通用户"],o=>a(L,{key:o,value:o},{default:t(()=>[s(r(o),1)]),_:2},1032,["value"])),64))]),_:2},1032,["modelValue","onUpdate:modelValue"])):d("",!0)]),_:1}),a(m,{prop:"switch",label:"状态",width:"70px"},{default:t(({row:e})=>[e.edit?d("",!0):(u(),y("span",Ge,r(e.switch?"启用":"禁用"),1)),e.edit?(u(),p(pe,{key:1,modelValue:e.switch,"onUpdate:modelValue":o=>e.switch=o},null,8,["modelValue","onUpdate:modelValue"])):d("",!0)]),_:1}),a(m,{prop:"prov",label:"省份",width:"120px"},{default:t(({row:e})=>[e.edit?d("",!0):(u(),y("span",He,r(e.prov??"未使用"),1)),e.edit?(u(),p(F,{key:1,modelValue:e.prov,"onUpdate:modelValue":o=>e.prov=o},{default:t(()=>[(u(),p(L,{key:null,value:null},{default:t(()=>[s("未使用")]),_:1})),(u(),y(z,null,I(["北京市","天津市","上海市","重庆市","河北省","山西省","内蒙古自治区","辽宁省","吉林省","黑龙江省","江苏省","浙江省","安徽省","福建省","江西省","山东省","河南省","湖北省","湖南省","广东省","广西壮族自治区","海南省","四川省","贵州省","云南省","西藏自治区","陕西省","甘肃省","青海省","宁夏回族自治区","新疆维吾尔自治区","香港特别行政区","澳门特别行政区","台湾省"],o=>a(L,{key:o,label:o,value:o},null,8,["label","value"])),64))]),_:2},1032,["modelValue","onUpdate:modelValue"])):d("",!0)]),_:1}),a(m,{prop:"reason",label:"禁用原因",width:"150px"},{default:t(({row:e})=>[e.edit?d("",!0):(u(),y("span",Oe,r(e.reason??"未禁用"),1)),e.edit?(u(),p(g,{key:1,modelValue:e.reason,"onUpdate:modelValue":o=>e.reason=o},null,8,["modelValue","onUpdate:modelValue"])):d("",!0)]),_:1}),a(m,{prop:"access_token",label:"access_token",width:"150px"},{default:t(({row:e})=>[e.edit?d("",!0):(u(),y("span",Je,r(e.access_token),1)),e.edit?(u(),p(g,{key:1,modelValue:e.access_token,"onUpdate:modelValue":o=>e.access_token=o},null,8,["modelValue","onUpdate:modelValue"])):d("",!0)]),_:1}),a(m,{prop:"refresh_token",label:"refresh_token",width:"150px"},{default:t(({row:e})=>[e.edit?d("",!0):(u(),y("span",Qe,r(e.refresh_token),1)),e.edit?(u(),p(g,{key:1,modelValue:e.refresh_token,"onUpdate:modelValue":o=>e.refresh_token=o},null,8,["modelValue","onUpdate:modelValue"])):d("",!0)]),_:1}),a(m,{prop:"cid",label:"cid",width:"200px"},{default:t(({row:e})=>[e.edit?d("",!0):(u(),y("span",We,r(e.cid),1)),e.edit?(u(),p(_e,{key:1,modelValue:e.cid,"onUpdate:modelValue":o=>e.cid=o,style:{width:"170px"}},null,8,["modelValue","onUpdate:modelValue"])):d("",!0)]),_:1}),a(m,{prop:"svip_end_at",label:"超级会员结束时间",width:"160px"},{default:t(({row:e})=>[s(r(new Date(e.svip_end_at).toLocaleString()),1)]),_:1}),a(m,{prop:"last_use_at",label:"上次使用时间",width:"160px"},{default:t(({row:e})=>[s(r(new Date(e.last_use_at).toLocaleString()),1)]),_:1}),a(m,{prop:"created_at",label:"创建时间",width:"160px"},{default:t(({row:e})=>[s(r(new Date(e.created_at).toLocaleString()),1)]),_:1}),a(m,{prop:"updated_at",label:"更新时间",width:"160px"},{default:t(({row:e})=>[s(r(new Date(e.updated_at).toLocaleString()),1)]),_:1}),a(m,{width:"350",label:"操作",fixed:"right"},{default:t(({row:e})=>[a(b,{size:"small",type:"primary",disabled:e.id===0,onClick:o=>q(e)},{default:t(()=>[s("更新信息")]),_:2},1032,["disabled","onClick"]),a(b,{size:"small",type:"primary",disabled:e.id===0,onClick:o=>N(e)},{default:t(()=>[s(" 检查封禁状态 ")]),_:2},1032,["disabled","onClick"]),e.edit?d("",!0):(u(),p(b,{key:0,size:"small",type:"primary",disabled:e.id===0,onClick:o=>D(e)},{default:t(()=>[s(" 編輯 ")]),_:2},1032,["disabled","onClick"])),e.edit?(u(),p(b,{key:1,size:"small",type:"primary",disabled:e.id===0,onClick:o=>D(e)},{default:t(()=>[s(" 完成 ")]),_:2},1032,["disabled","onClick"])):d("",!0),a(b,{size:"small",type:"danger",disabled:e.id===0,onClick:o=>P(e)},{default:t(()=>[s("删除")]),_:2},1032,["disabled","onClick"])]),_:1})]),_:1},8,["data"])),[[ye,i.value]]),a(fe,{"current-page":U.value,"onUpdate:currentPage":n[10]||(n[10]=e=>U.value=e),"page-size":S.value,"onUpdate:pageSize":n[11]||(n[11]=e=>S.value=e),"page-sizes":[15,50,100,500,((Q=$.value)==null?void 0:Q.total)??100],total:((W=$.value)==null?void 0:W.total)??100,layout:"total, sizes, prev, pager, next, jumper",onSizeChange:k,onCurrentChange:k},null,8,["current-page","page-size","page-sizes","total"])],64)}}}),Vt=$e(Xe,[["__scopeId","data-v-23ca496d"]]);export{Vt as default};
