(()=>{"use strict";var o,e={618:()=>{const o=window.wp.blocks,e=window.wp.i18n,t=window.wp.blockEditor,i=window.wp.coreData,r=(window.wp.components,window.ReactJSXRuntime),n=JSON.parse('{"UU":"site-functionality/publisher"}');(0,o.registerBlockType)(n.UU,{edit:function({context:{postType:o,postId:n}}){const[s,l]=(0,i.useEntityProp)("postType",o,"meta",n);console.log(o),console.log(n),console.log(s);const{publisher:a}=s;return(0,r.jsx)("div",{...(0,t.useBlockProps)(),children:(0,r.jsx)(t.RichText,{tagName:"p",placeholder:(0,e.__)("Publisher","site-functionality"),allowedFormats:["core/italic","core/link"],disableLineBreaks:!0,value:a,onChange:o=>l({...s,publisher:o})})})}})}},t={};function i(o){var r=t[o];if(void 0!==r)return r.exports;var n=t[o]={exports:{}};return e[o](n,n.exports,i),n.exports}i.m=e,o=[],i.O=(e,t,r,n)=>{if(!t){var s=1/0;for(p=0;p<o.length;p++){for(var[t,r,n]=o[p],l=!0,a=0;a<t.length;a++)(!1&n||s>=n)&&Object.keys(i.O).every((o=>i.O[o](t[a])))?t.splice(a--,1):(l=!1,n<s&&(s=n));if(l){o.splice(p--,1);var c=r();void 0!==c&&(e=c)}}return e}n=n||0;for(var p=o.length;p>0&&o[p-1][2]>n;p--)o[p]=o[p-1];o[p]=[t,r,n]},i.o=(o,e)=>Object.prototype.hasOwnProperty.call(o,e),(()=>{var o={924:0,452:0};i.O.j=e=>0===o[e];var e=(e,t)=>{var r,n,[s,l,a]=t,c=0;if(s.some((e=>0!==o[e]))){for(r in l)i.o(l,r)&&(i.m[r]=l[r]);if(a)var p=a(i)}for(e&&e(t);c<s.length;c++)n=s[c],i.o(o,n)&&o[n]&&o[n][0](),o[n]=0;return i.O(p)},t=globalThis.webpackChunksite_functionality=globalThis.webpackChunksite_functionality||[];t.forEach(e.bind(null,0)),t.push=e.bind(null,t.push.bind(t))})();var r=i.O(void 0,[452],(()=>i(618)));r=i.O(r)})();