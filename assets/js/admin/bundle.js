(()=>{function r(){let e=document.querySelectorAll("button[data-copy]");e&&e.forEach(t=>{t.addEventListener("click",o=>{o.preventDefault(),navigator.clipboard.writeText(t.dataset.copy).then(()=>{alert(t.dataset.copy+" \u06A9\u067E\u06CC \u0634\u062F!")}).catch(a=>{alert("\u062E\u0637\u0627 \u062F\u0631 \u06A9\u067E\u06CC \u06A9\u0631\u062F\u0646: "+a)})})})}r();})();
//# sourceMappingURL=bundle.js.map
