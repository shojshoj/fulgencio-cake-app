import { unref as e, ref as O, watch as G, computed as F, toRef as te, resolveComponent as Ye, openBlock as q, createElementBlock as $, normalizeClass as A, createElementVNode as V, renderSlot as E, withDirectives as De, vModelCheckbox as _e, createTextVNode as Ee, toDisplayString as Fe, vModelRadio as et, createCommentVNode as H, Fragment as Oe, renderList as Me, createBlock as je, withCtx as K, vShow as tt, readonly as ot, onMounted as nt, nextTick as lt } from "vue";
const I = Object.freeze({
  None: null,
  Single: "single",
  Multiple: "multiple",
  SelectionFollowsFocus: "selectionFollowsFocus"
});
function Ke() {
  function o() {
    const i = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    let f = "grt-";
    do
      f += i.charAt(Math.floor(Math.random() * i.length));
    while (f.length < 8 || document.getElementById(f));
    return f;
  }
  function l(i, f) {
    const s = i.treeNodeSpec.idProperty, c = i[s], h = i[i.treeNodeSpec.childrenProperty];
    if (document.getElementById(`${f}-${c}`)) {
      let t = 1;
      for (; document.getElementById(`${f}-${c}-${t}`); )
        t++;
      i[s] = `${c}-${t}`;
    }
    h.forEach((t) => l(t, f));
  }
  return { generateUniqueId: o, resolveNodeIdConflicts: l };
}
function we(o) {
  function l(s) {
    f(s, !1);
  }
  function i(s) {
    f(s, !0);
  }
  function f(s, c) {
    if (o.value.length === 0)
      return;
    let h = o.value.slice(), t = !0;
    for (; h.length > 0 && t !== !1; ) {
      let n = h.shift(), a = n.treeNodeSpec.childrenProperty;
      Array.isArray(n[a]) && (h = c ? n[a].concat(h) : h.concat(n[a])), t = s(n);
    }
  }
  return {
    breadthFirstTraverse: l,
    depthFirstTraverse: i
  };
}
function ze() {
  function o(i) {
    return e(i).treeNodeSpec.expandable === !0;
  }
  function l(i) {
    return e(i).treeNodeSpec.state.expanded === !0;
  }
  return {
    isExpandable: o,
    isExpanded: l
  };
}
function U() {
  const { isExpanded: o } = ze();
  function l(n) {
    e(n).treeNodeSpec.focusable = !0;
  }
  function i(n) {
    e(n).treeNodeSpec.focusable = !1;
  }
  function f(n) {
    return e(n).treeNodeSpec.focusable === !0;
  }
  function s(n) {
    n.length > 0 && l(n[0]);
  }
  function c(n) {
    let a = n[n.length - 1], p = a[a.treeNodeSpec.childrenProperty];
    for (; p.length > 0 && o(a); )
      a = p[p.length - 1], p = a[a.treeNodeSpec.childrenProperty];
    l(a);
  }
  function h(n, a, p) {
    let y = n.indexOf(a), v = a[a.treeNodeSpec.childrenProperty];
    if (!p && v.length > 0 && o(a))
      l(v[0]);
    else if (y < n.length - 1)
      l(n[y + 1]);
    else
      return !1;
    return !0;
  }
  function t(n, a) {
    let p = n.indexOf(a);
    if (p !== 0) {
      let y = n[p - 1], v = y[y.treeNodeSpec.childrenProperty];
      for (; v.length > 0 && o(y); )
        y = v[v.length - 1], v = y[y.treeNodeSpec.childrenProperty];
      return l(y), !0;
    }
    return !1;
  }
  return {
    focus: l,
    focusFirst: s,
    focusLast: c,
    focusNext: h,
    focusPrevious: t,
    isFocused: f,
    unfocus: i
  };
}
function it() {
  const { unfocus: o } = U(), l = O(null);
  function i(f) {
    l.value !== f && (l.value && o(l), l.value = f);
  }
  return {
    focusableNodeModel: l,
    handleFocusableChange: i
  };
}
function fe() {
  function o(c) {
    e(c).treeNodeSpec.state.selected = !0;
  }
  function l(c) {
    e(c).treeNodeSpec.state.selected = !1;
  }
  function i(c, h) {
    e(c).treeNodeSpec.state.selected = h;
  }
  function f(c) {
    return e(c).treeNodeSpec.selectable === !0;
  }
  function s(c) {
    return e(c).treeNodeSpec.state.selected === !0;
  }
  return {
    deselect: l,
    isSelectable: f,
    isSelected: s,
    setSelected: i,
    select: o
  };
}
const r = Object.freeze({
  RootNodesLoad: "treeRootNodesLoad",
  Click: "treeNodeClick",
  DoubleClick: "treeNodeDblclick",
  CheckboxChange: "treeNodeCheckboxChange",
  ChildCheckboxChange: "treeNodeChildCheckboxChange",
  RadioChange: "treeNodeRadioChange",
  ExpandedChange: "treeNodeExpandedChange",
  ChildrenLoad: "treeNodeChildrenLoad",
  SelectedChange: "treeNodeSelectedChange",
  FocusableChange: "treeNodeAriaFocusableChange",
  RequestFirstFocus: "treeNodeAriaRequestFirstFocus",
  RequestLastFocus: "treeNodeAriaRequestLastFocus",
  RequestParentFocus: "treeNodeAriaRequestParentFocus",
  RequestPreviousFocus: "treeNodeAriaRequestPreviousFocus",
  RequestNextFocus: "treeNodeAriaRequestNextFocus",
  Add: "treeNodeAdd",
  Delete: "treeNodeDelete",
  DragMove: "treeNodeDragMove",
  Drop: "treeNodeDrop"
});
function at(o, l, i, f) {
  const { depthFirstTraverse: s } = we(o), { deselect: c, isSelectable: h, isSelected: t, select: n } = fe();
  G(l, p), G(i, (C) => {
    e(l) === I.SelectionFollowsFocus && x(C);
  });
  const a = F(() => l.value === I.None ? null : l.value === I.Multiple);
  function p() {
    e(l) === I.Single ? y() : e(l) === I.SelectionFollowsFocus && v();
  }
  function y() {
    let C = !1;
    s((u) => {
      u.treeNodeSpec.state && t(u) && (C ? c(u) : C = !0);
    });
  }
  function v() {
    s((C) => {
      let u = C.treeNodeSpec.idProperty, b = i.value.treeNodeSpec.idProperty;
      C[u] === i.value[b] ? h(C) && n(C) : t(C) && c(C);
    });
  }
  function S(C) {
    e(l) === I.Single && t(C) && x(C), f(r.SelectedChange, C);
  }
  function x(C) {
    const u = C[C.treeNodeSpec.idProperty];
    s((b) => t(b) && b[b.treeNodeSpec.idProperty] !== u ? (c(b), !1) : !0);
  }
  return {
    ariaMultiselectable: a,
    enforceSelectionMode: p,
    handleNodeSelectedChange: S
  };
}
const Be = Object.freeze({
  None: "none",
  Copy: "copy",
  Move: "move",
  Link: "link"
}), ee = Object.freeze({
  None: "none",
  All: "all",
  Copy: "copy",
  Move: "move",
  Link: "link",
  CopyMove: "copyMove",
  CopyLink: "copyLink",
  LinkMove: "linkMove"
}), J = Object.freeze({
  Before: 0,
  After: 1,
  Child: 2
});
function He() {
  function o(i) {
    return i !== null && typeof i == "object" && !Array.isArray(i);
  }
  function l(i) {
    let f = JSON.parse(JSON.stringify(i));
    if (o(f))
      for (const s of Object.keys(i)) {
        let c = i[s];
        typeof c == "function" ? f[s] = c : o(c) && (f[s] = l(c));
      }
    return f;
  }
  return { isProbablyObject: o, cheapCopyObject: l };
}
const { resolveNodeIdConflicts: qe } = Ke(), { cheapCopyObject: rt } = He(), { unfocus: st } = U();
function dt(o, l, i, f) {
  function s(h) {
    const t = o.value.indexOf(h);
    t > -1 && o.value.splice(t, 1);
  }
  function c(h) {
    let t = h.droppedModel;
    if (h.isSameTree)
      if (h.dropEffect === Be.Move)
        t = f(t[t.treeNodeSpec.idProperty]), t.treeNodeSpec._.dragMoved = !0;
      else {
        let n = i(t[t.treeNodeSpec.idProperty]);
        t = rt(n), qe(t, l.value), st(t);
      }
    else
      qe(t, l.value);
    if (t) {
      let n = h.siblingNodeSet || o.value, a = n.indexOf(h.targetModel);
      switch (h.targetZone) {
        case J.Before:
          n.splice(a, 0, t);
          break;
        case J.After:
          n.splice(a + 1, 0, t);
          break;
        default:
          n.push(t);
          break;
      }
      t.treeNodeSpec._.dragging = !1;
    }
  }
  return {
    dragMoveNode: s,
    drop: c
  };
}
const oe = Object.freeze({
  Checkbox: "checkbox",
  RadioButton: "radio"
});
function ut(o, l, i) {
  const { depthFirstTraverse: f } = we(o), { isSelectable: s, isSelected: c } = fe();
  function h(v, S = 0) {
    let x = [];
    return typeof v == "function" && f((C) => {
      if (v(C))
        return x.push(C), S < 1 || x.length < S;
    }), x;
  }
  function t() {
    return h((v) => v.treeNodeSpec.input && v.treeNodeSpec.input.type === oe.Checkbox && v.treeNodeSpec.state.input.value);
  }
  function n() {
    return h((v) => v.treeNodeSpec.input && v.treeNodeSpec.input.type === oe.RadioButton && l.value[v.treeNodeSpec.input.name] === v.treeNodeSpec.input.value);
  }
  function a(v) {
    let S = null;
    return typeof v == "string" && (S = o.value.find((x) => x[x.treeNodeSpec.idProperty] === v), S || f((x) => {
      if (S = x[x.treeNodeSpec.childrenProperty].find((u) => u[u.treeNodeSpec.idProperty] === v), S)
        return !1;
    })), S;
  }
  function p() {
    return i.value === I.None ? [] : h((v) => s(v) && c(v));
  }
  function y(v) {
    let S = null;
    if (typeof v == "string") {
      let x = o.value.findIndex((C) => C[C.treeNodeSpec.idProperty] === v);
      x > -1 ? S = o.value.splice(x, 1)[0] : f((C) => {
        let u = C[C.treeNodeSpec.childrenProperty];
        if (x = u.findIndex((b) => b[b.treeNodeSpec.idProperty] === v), x > -1)
          return S = u.splice(x, 1)[0], !1;
      });
    }
    return S;
  }
  return {
    findById: a,
    getCheckedCheckboxes: t,
    getCheckedRadioButtons: n,
    getMatching: h,
    getSelected: p,
    removeById: y
  };
}
const { isProbablyObject: $e } = He(), ct = [ee.Copy, ee.Move, ee.CopyMove, ee.None];
function ft(o, l, i) {
  function f() {
    o.value.treeNodeSpec || (o.value.treeNodeSpec = {});
    const t = o.value.treeNodeSpec;
    s(e(l), t), typeof t.childrenProperty != "string" && (t.childrenProperty = "children"), typeof t.idProperty != "string" && (t.idProperty = "id"), typeof t.labelProperty != "string" && (t.labelProperty = "label"), Array.isArray(o.value[t.childrenProperty]) || (o.value[t.childrenProperty] = []), typeof t.expandable != "boolean" && (t.expandable = !0), typeof t.selectable != "boolean" && (t.selectable = !1), typeof t.deletable != "boolean" && (t.deletable = !1), typeof t.draggable != "boolean" && (t.draggable = !1), typeof t.allowDrop != "boolean" && (t.allowDrop = !1), (typeof t.dataTransferEffectAllowed != "string" || !ct.includes(t.dataTransferEffectAllowed)) && (t.dataTransferEffectAllowed = ee.CopyMove), typeof t.focusable != "boolean" && (t.focusable = !1), typeof t.addChildCallback != "function" && (t.addChildCallback = null), (typeof t.title != "string" || t.title.trim().length === 0) && (t.title = null), (typeof t.expanderTitle != "string" || t.expanderTitle.trim().length === 0) && (t.expanderTitle = null), (typeof t.addChildTitle != "string" || t.addChildTitle.trim().length === 0) && (t.addChildTitle = null), (typeof t.deleteTitle != "string" || t.deleteTitle.trim().length === 0) && (t.deleteTitle = null), (t.customizations == null || typeof t.customizations != "object") && (t.customizations = {}), typeof t.loadChildrenAsync != "function" && (t.loadChildrenAsync = null), t._ = {}, t._.dragging = !1, c(t), h(t), o.value.treeNodeSpec = t;
  }
  function s(t, n) {
    if ($e(t)) {
      const a = JSON.parse(JSON.stringify(t));
      Object.assign(a, n);
      for (const p of Object.keys(t)) {
        const y = typeof t[p] == "function" ? t[p] : a[p];
        $e(y) ? (n[p] = n[p] || {}, s(y, n[p])) : (typeof y == "function" && n[p], n[p] = y);
      }
    }
  }
  function c(t) {
    let n = t.input;
    n === null || typeof n != "object" || !Object.values(oe).includes(n.type) ? t.input = null : ((typeof n.name != "string" || n.name.trim().length === 0) && (n.name = null), n.type === oe.RadioButton && ((typeof n.name != "string" || n.name.trim().length === 0) && (n.name = "unspecifiedRadioName"), (typeof n.value != "string" || n.value.trim().length === 0) && (n.value = o.value[t.labelProperty].replace(/[\s&<>"'\/]/g, "")), i.value.hasOwnProperty(n.name) || (i.value[n.name] = ""), n.isInitialRadioGroupValue === !0 && (i.value[n.name] = n.value)));
  }
  function h(t) {
    (t.state === null || typeof t.state != "object") && (t.state = {}), (t._.state === null || typeof t._.state != "object") && (t._.state = {});
    let n = t.state, a = t._.state;
    a.areChildrenLoaded = typeof t.loadChildrenAsync != "function", a.areChildrenLoading = !1, (typeof n.expanded != "boolean" || !a.areChildrenLoaded) && (n.expanded = !1), typeof n.selected != "boolean" && (n.selected = !1), t.input && ((n.input === null || typeof n.input != "object") && (n.input = {}), (n.input.disabled === null || typeof n.input.disabled != "boolean") && (n.input.disabled = !1), t.input.type === oe.Checkbox && typeof n.input.value != "boolean" && (n.input.value = !1));
  }
  return {
    normalizeNodeData: f
  };
}
function Je(o, l) {
  const i = F(() => typeof o.value.treeNodeSpec.loadChildrenAsync != "function" || o.value.treeNodeSpec._.state.areChildrenLoaded), f = F(() => o.value.treeNodeSpec._.state.areChildrenLoading), s = F(() => {
    var p;
    return o.value[(p = o.value.treeNodeSpec.childrenProperty) != null ? p : "children"];
  }), c = F(() => s.value && s.value.length > 0), h = F(() => c.value || !i.value);
  async function t() {
    const p = o.value.treeNodeSpec;
    if (!p._.state.areChildrenLoaded && !p._.state.areChildrenLoading) {
      p._.state.areChildrenLoading = !0;
      var y = await p.loadChildrenAsync(o.value);
      y && (p._.state.areChildrenLoaded = !0, s.value.splice(0, s.value.length, ...y), l(r.ChildrenLoad, o.value)), p._.state.areChildrenLoading = !1;
    }
  }
  async function n() {
    if (o.value.treeNodeSpec.addChildCallback) {
      var p = await o.value.treeNodeSpec.addChildCallback(o.value);
      p && (s.value.push(p), l(r.Add, p, o.value));
    }
  }
  function a(p) {
    let y = s.value.indexOf(p);
    y > -1 && (s.value.splice(y, 1), l(r.Delete, p));
  }
  return {
    addChild: n,
    areChildrenLoaded: i,
    areChildrenLoading: f,
    children: s,
    deleteChild: a,
    hasChildren: c,
    loadChildren: t,
    mayHaveChildren: h
  };
}
const _ = Object.freeze({
  Json: "application/json",
  PlainText: "text/plain",
  TreeViewNode: "application/x-grapoza-treeviewnode"
});
function pt() {
  function o(l, i) {
    return (l.closest ? l : l.parentElement).closest(i);
  }
  return {
    closest: o
  };
}
const { closest: gt } = pt();
function vt(o, l, i, f) {
  const { unfocus: s } = U(), c = o.value.treeNodeSpec;
  function h(u) {
    const b = l.value.indexOf(u);
    b > -1 && l.value.splice(b, 1);
  }
  function t(u, b) {
    u.siblingNodeSet = u.siblingNodeSet || l.value, f(r.Drop, u, b);
  }
  function n(u) {
    u.stopPropagation();
    let b = JSON.parse(JSON.stringify(o.value));
    s(b), b = JSON.stringify(b), c._.dragging = !0, u.dataTransfer.effectAllowed = c.dataTransferEffectAllowed, u.dataTransfer.setData(_.TreeViewNode, `{"treeId":"${i.value}","data":${b}}`), u.dataTransfer.setData(_.Json, b), u.dataTransfer.setData(_.PlainText, b);
  }
  function a(u) {
    x(u) && (C(u, !0), u.preventDefault());
  }
  function p(u) {
    x(u) && (C(u, !0), u.preventDefault());
  }
  function y(u) {
    x(u) && C(u, !1);
  }
  function v(u) {
    const b = JSON.parse(u.dataTransfer.getData(_.TreeViewNode)), R = u.target.classList.contains("grtvn-self-prev-target") ? J.Before : u.target.classList.contains("grtvn-self-next-target") ? J.After : J.Child, N = {
      isSameTree: b.treeId === i.value,
      droppedModel: b.data,
      targetModel: o.value,
      siblingNodeSet: R === J.Child ? l.value : null,
      dropEffect: u.dataTransfer.dropEffect,
      targetZone: R
    };
    f(r.Drop, N, u), C(u, !1), u.preventDefault();
  }
  function S(u) {
    u.dataTransfer.dropEffect === Be.Move ? c._.dragMoved ? delete c._.dragMoved : f(r.DragMove, o.value, u) : (C(u, !1), c._.dragging = !1);
  }
  function x(u) {
    return c.allowDrop && u.dataTransfer.types.includes(_.TreeViewNode) && !gt(u.target, ".grtvn-dragging");
  }
  function C(u, b) {
    const R = u.target.classList && u.target.classList.contains("grtvn-self-prev-target"), N = u.target.classList && u.target.classList.contains("grtvn-self-next-target");
    c._.isDropTarget = b, R ? (c._.isPrevDropTarget = b, c._.isChildDropTarget = !1) : N ? (c._.isNextDropTarget = b, c._.isChildDropTarget = !1) : c._.isChildDropTarget = b;
  }
  return {
    dragMoveChild: h,
    drop: t,
    onDragstart: n,
    onDragenter: a,
    onDragover: p,
    onDragleave: y,
    onDrop: v,
    onDragend: S
  };
}
function Nt(o, l, i, f) {
  const { focus: s, focusFirst: c, focusLast: h, focusNext: t, focusPrevious: n, isFocused: a, unfocus: p } = U(), y = F(() => o.value[o.value.treeNodeSpec.childrenProperty]);
  G(() => o.value.treeNodeSpec.focusable, function(N) {
    N === !0 && (f.value && l.value.focus(), i(r.FocusableChange, o.value));
  });
  function v() {
    s(o);
  }
  function S() {
    p(o);
  }
  function x() {
    return a(o);
  }
  function C() {
    c(y.value);
  }
  function u() {
    h(y.value);
  }
  function b(N, z) {
    t(y.value, N, z) || i(r.RequestNextFocus, e(o), !0);
  }
  function R(N) {
    n(y.value, N) || v();
  }
  return {
    focusNode: v,
    unfocusNode: S,
    isFocusedNode: x,
    focusFirstChild: C,
    focusLastChild: u,
    focusNextNode: b,
    focusPreviousNode: R
  };
}
function ht(o, l, i) {
  const {
    deselect: f,
    isSelectable: s,
    isSelected: c,
    setSelected: h,
    select: t
  } = fe();
  G(() => o.value.treeNodeSpec.state.selected, () => {
    i(r.SelectedChange, o.value);
  }), G(() => o.value.treeNodeSpec.focusable, function(C) {
    v() && l.value === I.SelectionFollowsFocus && p(C);
  });
  function n() {
    t(o);
  }
  function a() {
    f(o);
  }
  function p(C) {
    h(o, C);
  }
  function y() {
    s(o) && [I.Single, I.Multiple].includes(l.value) && h(o, !S());
  }
  function v() {
    return s(o);
  }
  function S() {
    return c(o);
  }
  return {
    ariaSelected: F(() => l.value === I.None || !v() ? null : l.value !== I.Multiple ? S() ? !0 : null : S()),
    deselectNode: a,
    isNodeSelectable: v,
    isNodeSelected: S,
    setNodeSelected: p,
    selectNode: n,
    toggleNodeSelected: y
  };
}
function Ct(o, l) {
  const {
    isExpandable: i,
    isExpanded: f
  } = ze(), {
    loadChildren: s,
    mayHaveChildren: c
  } = Je(o, l), h = F(() => t.value ? a() : null), t = F(() => c.value && n());
  G(() => o.value.treeNodeSpec.state.expanded, async function() {
    l(r.ExpandedChange, o.value), a() && await s();
  });
  function n() {
    return i(o);
  }
  function a() {
    return f(o);
  }
  function p() {
    return t.value && a() ? (o.value.treeNodeSpec.state.expanded = !1, !0) : !1;
  }
  function y() {
    return t.value && !a() ? (o.value.treeNodeSpec.state.expanded = !0, !0) : !1;
  }
  function v() {
    return a() ? p() : y();
  }
  return {
    ariaExpanded: h,
    canExpand: t,
    collapseNode: p,
    expandNode: y,
    isNodeExpandable: n,
    isNodeExpanded: a,
    toggleNodeExpanded: v
  };
}
const yt = ["id", "tabindex", "aria-expanded", "aria-selected"], bt = ["draggable", "dragging"], St = ["id", "title"], mt = ["for", "title"], xt = ["id", "disabled"], kt = ["for", "title"], Tt = ["id", "name", "value", "disabled"], Dt = ["title"], Ft = ["id", "title"], wt = ["id", "title"], Pt = ["aria-hidden"], At = {
  __name: "TreeViewNode",
  props: {
    ariaKeyMap: {
      type: Object,
      required: !0
    },
    depth: {
      type: Number,
      required: !0
    },
    initialModel: {
      type: Object,
      required: !0
    },
    initialRadioGroupValues: {
      type: Object,
      required: !0
    },
    isMounted: {
      type: Boolean,
      required: !0
    },
    modelDefaults: {
      type: Object,
      required: !0
    },
    selectionMode: {
      type: String,
      required: !1,
      default: I.None,
      validator: function(o) {
        return Object.values(I).includes(o);
      }
    },
    treeId: {
      type: String,
      required: !0
    }
  },
  emits: [
    r.Add,
    r.Click,
    r.CheckboxChange,
    r.ChildCheckboxChange,
    r.ChildrenLoad,
    r.Delete,
    r.DoubleClick,
    r.DragMove,
    r.Drop,
    r.ExpandedChange,
    r.FocusableChange,
    r.RadioChange,
    r.RequestFirstFocus,
    r.RequestLastFocus,
    r.RequestNextFocus,
    r.RequestParentFocus,
    r.RequestPreviousFocus,
    r.SelectedChange
  ],
  setup(o, { emit: l }) {
    const i = o, f = "input, .grtvn-self-expander, .grtvn-self-expander *, .grtvn-self-action, .grtvn-self-action *", s = O(i.initialModel), c = O(i.initialRadioGroupValues), h = O(null), t = F(() => `${R.value}-add-child`), n = F(() => be() ? 0 : -1), a = F(() => {
      var d, g;
      return (g = (d = N.value.customizations) == null ? void 0 : d.classes) != null ? g : {};
    }), p = F(() => `${R.value}-delete`), y = F(() => `${R.value}-exp`), v = F(() => s.value[S.value]), S = F(() => {
      var d;
      return (d = N.value.idProperty) != null ? d : "id";
    }), x = F(() => `${R.value}-input`), C = F(() => i.selectionMode !== I.None && Q() && me()), u = F(() => s.value[b.value]), b = F(() => {
      var d;
      return (d = N.value.labelProperty) != null ? d : "label";
    }), R = F(() => `${i.treeId}-${v.value}`), N = F(() => s.value.treeNodeSpec), z = F(() => i.treeId), { normalizeNodeData: pe } = ft(s, i.modelDefaults, c);
    pe();
    const {
      addChild: Z,
      areChildrenLoaded: ne,
      areChildrenLoading: ge,
      children: M,
      deleteChild: ve,
      hasChildren: Ne,
      mayHaveChildren: he
    } = Je(s, l), {
      focus: Ce,
      isFocused: ye
    } = U(), {
      focusNode: le,
      focusNextNode: ie,
      focusPreviousNode: ae,
      isFocusedNode: be
    } = Nt(s, h, l, te(i, "isMounted")), {
      ariaSelected: Se,
      isNodeSelectable: Q,
      isNodeSelected: me,
      toggleNodeSelected: re
    } = ht(s, te(i, "selectionMode"), l), {
      ariaExpanded: xe,
      canExpand: ke,
      collapseNode: k,
      expandNode: m,
      isNodeExpanded: W,
      toggleNodeExpanded: X
    } = Ct(s, l), {
      dragMoveChild: se,
      drop: T,
      onDragstart: P,
      onDragenter: j,
      onDragover: B,
      onDragleave: de,
      onDrop: Pe,
      onDragend: Ae
    } = vt(s, M, z, l);
    function Ie(d) {
      l(r.CheckboxChange, s.value, d);
    }
    function Le(d) {
      l(r.RadioChange, s.value, d);
    }
    function Ge(d) {
      d.target.matches(f) || (l(r.Click, s.value, d), re()), le();
    }
    function Ue(d) {
      d.target.matches(f) || l(r.DoubleClick, s.value, d);
    }
    function Re(d) {
      N.value.deletable && l(r.Delete, s.value);
    }
    function Ze(d) {
      let g = !0;
      if (!(d.altKey || d.ctrlKey || d.metaKey || d.shift)) {
        if (i.ariaKeyMap.activateItem.includes(d.keyCode)) {
          if (N.value.input && !N.value.state.input.disabled) {
            let ue = h.value.querySelector(".grtvn-self"), D = ue.querySelector(".grtvn-self-input") || ue.querySelector("input");
            if (D) {
              let ce = new MouseEvent("click", { view: window, bubbles: !0, cancelable: !0 });
              D.dispatchEvent(ce);
            }
          }
        } else
          i.ariaKeyMap.selectItem.includes(d.keyCode) ? re() : i.ariaKeyMap.expandFocusedItem.includes(d.keyCode) ? he.value && !ge.value && !m() && W() && Ce(M.value[0]) : i.ariaKeyMap.collapseFocusedItem.includes(d.keyCode) ? k() || l(r.RequestParentFocus) : i.ariaKeyMap.focusFirstItem.includes(d.keyCode) ? l(r.RequestFirstFocus) : i.ariaKeyMap.focusLastItem.includes(d.keyCode) ? l(r.RequestLastFocus) : i.ariaKeyMap.focusPreviousItem.includes(d.keyCode) ? l(r.RequestPreviousFocus, s.value) : i.ariaKeyMap.focusNextItem.includes(d.keyCode) ? l(r.RequestNextFocus, s.value, !1) : i.ariaKeyMap.insertItem.includes(d.keyCode) ? Z() : i.ariaKeyMap.deleteItem.includes(d.keyCode) ? Re() : g = !1;
        g && (d.stopPropagation(), d.preventDefault());
      }
    }
    function Qe(d) {
      M.value.indexOf(d) > -1 && (ye(d) && (M.value.length > 1 && M.value.indexOf(d) === 0 ? ie(d) : ae(d)), ve(d));
    }
    function We(d, g) {
      l(r.CheckboxChange, d, g), M.value.includes(d) && l(r.ChildCheckboxChange, s.value, d, g);
    }
    return (!v.value || typeof v.value != "number" && typeof v.value != "string") && console.error(`initialModel id is required and must be a number or string. Expected prop ${S.value} to exist on the model.`), (!u.value || typeof u.value != "string") && console.error(`initialModel label is required and must be a string. Expected prop ${b.value} to exist on the model.`), (d, g) => {
      const ue = Ye("TreeViewNode", !0);
      return q(), $("li", {
        id: e(R),
        ref_key: "nodeElement",
        ref: h,
        class: A(["grtvn", [
          e(a).treeViewNode,
          e(N)._.dragging ? "grtvn-dragging" : ""
        ]]),
        role: "treeitem",
        tabindex: e(n),
        "aria-expanded": e(xe),
        "aria-selected": e(Se),
        onKeydown: Ze
      }, [
        V("div", {
          class: A(["grtvn-self", [
            e(a).treeViewNodeSelf,
            e(C) ? "grtvn-self-selected" : "",
            e(C) ? e(a).treeViewNodeSelfSelected : "",
            e(N)._.isDropTarget ? "grtvn-self-drop-target" : "",
            e(N)._.isChildDropTarget ? "grtvn-self-child-drop-target" : ""
          ]]),
          draggable: e(N).draggable,
          dragging: e(N)._.dragging,
          onClick: Ge,
          onDblclick: Ue,
          onDragend: g[4] || (g[4] = (...D) => e(Ae) && e(Ae)(...D)),
          onDragenter: g[5] || (g[5] = (...D) => e(j) && e(j)(...D)),
          onDragleave: g[6] || (g[6] = (...D) => e(de) && e(de)(...D)),
          onDragover: g[7] || (g[7] = (...D) => e(B) && e(B)(...D)),
          onDragstart: g[8] || (g[8] = (...D) => e(P) && e(P)(...D)),
          onDrop: g[9] || (g[9] = (...D) => e(Pe) && e(Pe)(...D))
        }, [
          V("div", {
            class: A(["grtvn-self-sibling-drop-target grtvn-self-prev-target", [e(N)._.isPrevDropTarget ? "grtvn-self-sibling-drop-target-hover" : ""]])
          }, null, 2),
          e(ke) ? (q(), $("button", {
            key: 0,
            id: e(y),
            type: "button",
            "aria-hidden": "true",
            tabindex: "-1",
            title: e(N).expanderTitle,
            class: A(["grtvn-self-expander", [
              e(a).treeViewNodeSelfExpander,
              e(N).state.expanded ? "grtvn-self-expanded" : "",
              e(N).state.expanded ? e(a).treeViewNodeSelfExpanded : ""
            ]]),
            onClick: g[0] || (g[0] = (...D) => e(X) && e(X)(...D))
          }, [
            V("i", {
              class: A(["grtvn-self-expanded-indicator", e(a).treeViewNodeSelfExpandedIndicator])
            }, null, 2)
          ], 10, St)) : (q(), $("span", {
            key: 1,
            class: A(["grtvn-self-spacer", e(a).treeViewNodeSelfSpacer])
          }, null, 2)),
          e(N).input && e(N).input.type === "checkbox" ? E(d.$slots, "checkbox", {
            key: 2,
            model: s.value,
            customClasses: e(a),
            inputId: e(x),
            checkboxChangeHandler: Ie
          }, () => [
            V("label", {
              for: e(x),
              title: e(N).title,
              class: A(["grtvn-self-label", e(a).treeViewNodeSelfLabel])
            }, [
              De(V("input", {
                id: e(x),
                tabindex: "-1",
                class: A(["grtvn-self-input grtvn-self-checkbox", [e(a).treeViewNodeSelfInput, e(a).treeViewNodeSelfCheckbox]]),
                type: "checkbox",
                disabled: e(N).state.input.disabled,
                "onUpdate:modelValue": g[1] || (g[1] = (D) => e(N).state.input.value = D),
                onChange: Ie
              }, null, 42, xt), [
                [_e, e(N).state.input.value]
              ]),
              Ee(" " + Fe(e(u)), 1)
            ], 10, mt)
          ]) : e(N).input && e(N).input.type === "radio" ? E(d.$slots, "radio", {
            key: 3,
            model: s.value,
            customClasses: e(a),
            inputId: e(x),
            radioGroupValues: c.value,
            radioChangeHandler: Le
          }, () => [
            V("label", {
              for: e(x),
              title: e(N).title,
              class: A(["grtvn-self-label", e(a).treeViewNodeSelfLabel])
            }, [
              De(V("input", {
                id: e(x),
                tabindex: "-1",
                class: A(["grtvn-self-input grtvn-self-radio", [e(a).treeViewNodeSelfInput, e(a).treeViewNodeSelfRadio]]),
                type: "radio",
                name: e(N).input.name,
                value: e(N).input.value,
                disabled: e(N).state.input.disabled,
                "onUpdate:modelValue": g[2] || (g[2] = (D) => c.value[e(N).input.name] = D),
                onChange: Le
              }, null, 42, Tt), [
                [et, c.value[e(N).input.name]]
              ]),
              Ee(" " + Fe(e(u)), 1)
            ], 10, kt)
          ]) : E(d.$slots, "text", {
            key: 4,
            model: s.value,
            customClasses: e(a)
          }, () => [
            V("span", {
              title: e(N).title,
              class: A(["grtvn-self-text", e(a).treeViewNodeSelfText])
            }, Fe(e(u)), 11, Dt)
          ]),
          e(N).addChildCallback ? (q(), $("button", {
            key: 5,
            id: e(t),
            type: "button",
            "aria-hidden": "true",
            tabindex: "-1",
            title: e(N).addChildTitle,
            class: A(["grtvn-self-action", [e(a).treeViewNodeSelfAction, e(a).treeViewNodeSelfAddChild]]),
            onClick: g[3] || (g[3] = (...D) => e(Z) && e(Z)(...D))
          }, [
            V("i", {
              class: A(["grtvn-self-add-child-icon", e(a).treeViewNodeSelfAddChildIcon])
            }, null, 2)
          ], 10, Ft)) : H("", !0),
          e(N).deletable ? (q(), $("button", {
            key: 6,
            id: e(p),
            type: "button",
            "aria-hidden": "true",
            tabindex: "-1",
            title: e(N).deleteTitle,
            class: A(["grtvn-self-action", [e(a).treeViewNodeSelfAction, e(a).treeViewNodeSelfDelete]]),
            onClick: Re
          }, [
            V("i", {
              class: A(["grtvn-self-delete-icon", e(a).treeViewNodeSelfDeleteIcon])
            }, null, 2)
          ], 10, wt)) : H("", !0),
          V("div", {
            class: A(["grtvn-self-sibling-drop-target grtvn-self-next-target", [e(N)._.isNextDropTarget ? "grtvn-self-sibling-drop-target-hover" : ""]])
          }, null, 2)
        ], 42, bt),
        V("div", {
          class: A(["grtvn-children-wrapper", e(a).treeViewNodeChildrenWrapper])
        }, [
          e(N).state.expanded && !e(ne) ? E(d.$slots, "loading", {
            key: 0,
            model: s.value,
            customClasses: e(a)
          }, () => [
            V("span", {
              class: A(["grtvn-loading", e(a).treeViewNodeLoading])
            }, " ... ", 2)
          ]) : H("", !0),
          e(Ne) ? De((q(), $("ul", {
            key: 1,
            class: A(["grtvn-children", e(a).treeViewNodeChildren]),
            role: "group",
            "aria-hidden": !e(N).state.expanded
          }, [
            (q(!0), $(Oe, null, Me(e(M), (D) => {
              var ce, Ve;
              return q(), je(ue, {
                key: D[(Ve = (ce = D.treeNodeSpec) == null ? void 0 : ce.idProperty) != null ? Ve : "id"],
                depth: o.depth + 1,
                "initial-model": D,
                "model-defaults": o.modelDefaults,
                "parent-id": e(v),
                "selection-mode": o.selectionMode,
                "tree-id": e(z),
                "initial-radio-group-values": c.value,
                "aria-key-map": o.ariaKeyMap,
                "is-mounted": o.isMounted,
                onTreeNodeClick: g[10] || (g[10] = (w, L) => d.$emit(e(r).Click, w, L)),
                onTreeNodeDblclick: g[11] || (g[11] = (w, L) => d.$emit(e(r).DoubleClick, w, L)),
                onTreeNodeCheckboxChange: We,
                onTreeNodeChildCheckboxChange: g[12] || (g[12] = (w, L, Y) => d.$emit(e(r).ChildCheckboxChange, w, L, Y)),
                onTreeNodeRadioChange: g[13] || (g[13] = (w, L) => d.$emit(e(r).RadioChange, w, L)),
                onTreeNodeExpandedChange: g[14] || (g[14] = (w) => d.$emit(e(r).ExpandedChange, w)),
                onTreeNodeChildrenLoad: g[15] || (g[15] = (w) => d.$emit(e(r).ChildrenLoad, w)),
                onTreeNodeSelectedChange: g[16] || (g[16] = (w) => d.$emit(e(r).SelectedChange, w)),
                onTreeNodeAdd: g[17] || (g[17] = (w, L) => d.$emit(e(r).Add, w, L)),
                onTreeNodeDelete: Qe,
                onTreeNodeAriaFocusableChange: g[18] || (g[18] = (w) => d.$emit(e(r).FocusableChange, w)),
                onTreeNodeAriaRequestParentFocus: g[19] || (g[19] = () => e(le)()),
                onTreeNodeAriaRequestFirstFocus: g[20] || (g[20] = () => d.$emit(e(r).RequestFirstFocus)),
                onTreeNodeAriaRequestLastFocus: g[21] || (g[21] = () => d.$emit(e(r).RequestLastFocus)),
                onTreeNodeAriaRequestPreviousFocus: e(ae),
                onTreeNodeAriaRequestNextFocus: e(ie),
                onTreeNodeDragMove: e(se),
                onTreeNodeDrop: e(T)
              }, {
                checkbox: K(({ model: w, customClasses: L, inputId: Y, checkboxChangeHandler: Te }) => [
                  E(d.$slots, "checkbox", {
                    model: w,
                    customClasses: L,
                    inputId: Y,
                    checkboxChangeHandler: Te
                  })
                ]),
                radio: K(({ model: w, customClasses: L, inputId: Y, radioGroupValues: Te, radioChangeHandler: Xe }) => [
                  E(d.$slots, "radio", {
                    model: w,
                    customClasses: L,
                    inputId: Y,
                    radioGroupValues: Te,
                    radioChangeHandler: Xe
                  })
                ]),
                text: K(({ model: w, customClasses: L }) => [
                  E(d.$slots, "text", {
                    model: w,
                    customClasses: L
                  })
                ]),
                loading: K(({ model: w, customClasses: L }) => [
                  E(d.$slots, "loading", {
                    model: w,
                    customClasses: L
                  })
                ]),
                _: 2
              }, 1032, ["depth", "initial-model", "model-defaults", "parent-id", "selection-mode", "tree-id", "initial-radio-group-values", "aria-key-map", "is-mounted", "onTreeNodeAriaRequestPreviousFocus", "onTreeNodeAriaRequestNextFocus", "onTreeNodeDragMove", "onTreeNodeDrop"]);
            }), 128))
          ], 10, Pt)), [
            [tt, e(N).state.expanded]
          ]) : H("", !0)
        ], 2)
      ], 42, yt);
    };
  }
};
const It = /* @__PURE__ */ V("span", { class: "grtv-loading" }, " ... ", -1), Lt = ["aria-multiselectable"], Vt = {
  __name: "TreeView",
  props: {
    customAriaKeyMap: {
      type: Object,
      required: !1,
      default: function() {
        return {};
      },
      validator: function(o) {
        for (const l in o)
          if (!Array.isArray(o[l]) || o[l].some((i) => !Number.isInteger(i)))
            return console.error(`customAriaKeyMap properties must be Arrays of numbers (corresponding to keyCodes); property '${l}' fails check.`), !1;
        return !0;
      }
    },
    initialModel: {
      type: Array,
      required: !1,
      default: function() {
        return [];
      }
    },
    loadNodesAsync: {
      type: Function,
      required: !1,
      default: null
    },
    modelDefaults: {
      type: Object,
      required: !1,
      default: function() {
        return {};
      }
    },
    selectionMode: {
      type: String,
      required: !1,
      default: I.None,
      validator: function(o) {
        return Object.values(I).includes(o);
      }
    },
    skinClass: {
      type: String,
      required: !1,
      default: "grtv-default-skin",
      validator: function(o) {
        return o === null || !o.match(/\s/);
      }
    }
  },
  emits: [
    r.Add,
    r.CheckboxChange,
    r.ChildrenLoad,
    r.ChildCheckboxChange,
    r.Click,
    r.Delete,
    r.DoubleClick,
    r.ExpandedChange,
    r.RadioChange,
    r.RootNodesLoad,
    r.SelectedChange
  ],
  setup(o, { expose: l, emit: i }) {
    const f = o, s = ot({
      activateItem: [32],
      selectItem: [13],
      focusLastItem: [35],
      focusFirstItem: [36],
      collapseFocusedItem: [37],
      expandFocusedItem: [39],
      focusPreviousItem: [38],
      focusNextItem: [40],
      insertItem: [45],
      deleteItem: [46]
    }), c = O(!1), h = O(!1), t = O(f.initialModel), n = O({}), a = O(""), p = O(null), { generateUniqueId: y } = Ke(), { depthFirstTraverse: v } = we(t), {
      focusableNodeModel: S,
      handleFocusableChange: x
    } = it(), {
      focus: C,
      focusFirst: u,
      focusLast: b,
      focusNext: R,
      focusPrevious: N,
      isFocused: z,
      unfocus: pe
    } = U(), {
      ariaMultiselectable: Z,
      enforceSelectionMode: ne,
      handleNodeSelectedChange: ge
    } = at(t, te(f, "selectionMode"), S, i), {
      isSelectable: M,
      isSelected: ve,
      select: Ne
    } = fe(te(f, "selectionMode")), {
      findById: he,
      getCheckedCheckboxes: Ce,
      getCheckedRadioButtons: ye,
      getMatching: le,
      getSelected: ie,
      removeById: ae
    } = ut(t, n, te(f, "selectionMode")), { dragMoveNode: be, drop: Se } = dt(t, a, he, ae), Q = F(() => typeof f.loadNodesAsync != "function" || c.value), me = F(() => Object.assign({}, s, f.customAriaKeyMap));
    nt(async () => {
      if (await re(), p.value.id && (a.value = p.value.id), t.value.length > 0) {
        let k = null;
        v((m) => {
          z(m) && (S.value ? pe(m) : S.value = m), f.selectionMode !== I.None && k === null && ve(m) && (k = m);
        }), S.value || (S.value = k || t.value[0], C(S)), k === null && M(S) && f.selectionMode === I.SelectionFollowsFocus && Ne(S), ne();
      }
      lt(() => {
        f.selectionMode === I.Single && ne(), h.value = !0;
      });
    });
    async function re() {
      if (!Q.value) {
        var k = await f.loadNodesAsync();
        k && (c.value = !0, t.value.splice(0, t.value.length, ...k), i(r.RootNodesLoad, t.value));
      }
    }
    function xe(k) {
      let m = t.value.indexOf(k);
      m > -1 && (ke(k), t.value.splice(m, 1)), i(r.Delete, k);
    }
    function ke(k) {
      z(k) && (t.value.indexOf(k) === 0 ? t.value.length > 0 && R(t.value, k) : N(t.value, k));
    }
    return a.value = y(), l({
      getCheckedCheckboxes: Ce,
      getCheckedRadioButtons: ye,
      getMatching: le,
      getSelected: ie
    }), (k, m) => (q(), $("div", {
      ref_key: "treeElement",
      ref: p,
      class: A(["grtv-wrapper", o.skinClass])
    }, [
      e(Q) ? H("", !0) : E(k.$slots, "loading-root", { key: 0 }, () => [
        It
      ]),
      e(Q) ? (q(), $("ul", {
        key: 1,
        class: "grtv",
        role: "tree",
        "aria-multiselectable": e(Z)
      }, [
        (q(!0), $(Oe, null, Me(t.value, (W) => {
          var X, se;
          return q(), je(At, {
            key: W[(se = (X = W.treeNodeSpec) == null ? void 0 : X.idProperty) != null ? se : "id"],
            "aria-key-map": e(me),
            depth: 0,
            "model-defaults": o.modelDefaults,
            "initial-model": W,
            "selection-mode": o.selectionMode,
            "tree-id": a.value,
            "is-mounted": h.value,
            "initial-radio-group-values": n.value,
            onTreeNodeClick: m[0] || (m[0] = (T, P) => k.$emit(e(r).Click, T, P)),
            onTreeNodeDblclick: m[1] || (m[1] = (T, P) => k.$emit(e(r).DoubleClick, T, P)),
            onTreeNodeCheckboxChange: m[2] || (m[2] = (T, P) => k.$emit(e(r).CheckboxChange, T, P)),
            onTreeNodeChildCheckboxChange: m[3] || (m[3] = (T, P, j) => k.$emit(e(r).ChildCheckboxChange, T, P, j)),
            onTreeNodeRadioChange: m[4] || (m[4] = (T, P) => k.$emit(e(r).RadioChange, T, P)),
            onTreeNodeExpandedChange: m[5] || (m[5] = (T) => k.$emit(e(r).ExpandedChange, T)),
            onTreeNodeChildrenLoad: m[6] || (m[6] = (T) => k.$emit(e(r).ChildrenLoad, T)),
            onTreeNodeSelectedChange: e(ge),
            onTreeNodeAdd: m[7] || (m[7] = (T, P) => k.$emit(e(r).Add, T, P)),
            onTreeNodeDelete: xe,
            onTreeNodeAriaFocusableChange: e(x),
            onTreeNodeAriaRequestFirstFocus: m[8] || (m[8] = (T) => e(u)(t.value)),
            onTreeNodeAriaRequestLastFocus: m[9] || (m[9] = (T) => e(b)(t.value)),
            onTreeNodeAriaRequestPreviousFocus: m[10] || (m[10] = (T) => e(N)(t.value, T)),
            onTreeNodeAriaRequestNextFocus: m[11] || (m[11] = (T, P) => e(R)(t.value, T, P)),
            onTreeNodeDragMove: e(be),
            onTreeNodeDrop: e(Se)
          }, {
            checkbox: K(({ model: T, customClasses: P, inputId: j, checkboxChangeHandler: B }) => [
              E(k.$slots, "checkbox", {
                model: T,
                customClasses: P,
                inputId: j,
                checkboxChangeHandler: B
              })
            ]),
            radio: K(({ model: T, customClasses: P, inputId: j, radioGroupValues: B, radioChangeHandler: de }) => [
              E(k.$slots, "radio", {
                model: T,
                customClasses: P,
                inputId: j,
                radioGroupValues: B,
                radioChangeHandler: de
              })
            ]),
            text: K(({ model: T, customClasses: P }) => [
              E(k.$slots, "text", {
                model: T,
                customClasses: P
              })
            ]),
            loading: K(({ model: T, customClasses: P }) => [
              E(k.$slots, "loading", {
                model: T,
                customClasses: P
              })
            ]),
            _: 2
          }, 1032, ["aria-key-map", "model-defaults", "initial-model", "selection-mode", "tree-id", "is-mounted", "initial-radio-group-values", "onTreeNodeSelectedChange", "onTreeNodeAriaFocusableChange", "onTreeNodeDragMove", "onTreeNodeDrop"]);
        }), 128))
      ], 8, Lt)) : H("", !0)
    ], 2));
  }
};
export {
  Vt as TreeView
};
