<template>
	<ul class="tree-menu list-unstyled" :class="ulClass">
		<li :class="liClass" :style="liStyle">
			<a :href="getPageUrl()" class="anchor-custom" style="color: #444" :dusk="pageSlug">{{ title }}</a>
		</li>

		<tree
			v-for="child in children"
			:key="child.id"
			:courseSlug="courseSlug"
			:pageSlug="child.slug"
			:title="child.title"
			:children="child.children"
			:depth="depth + 1"
		></tree>
	</ul>
</template>
<script>
export default {
	name: 'tree',
	props: ['courseSlug', 'pageSlug', 'title', 'children', 'depth'],
	data() {
		return {
			ulClass: {},
			liClass: {},
			liStyle: {
				'padding-left': this.depth * 20 + 'px',
			}
		};
	},
	created() {
		if (this.depth == 0) {
			this.ulClass['list-group-item list-group-item-action p-4'] = true;
			this.liClass['font-weight-bold'] = true;
		}

		if (this.depth == -1) {
			this.ulClass['list-group'] = true;
		}
	},
	methods: {
		getPageUrl() {
			return '/courses/' + this.courseSlug + '/pages/' + this.pageSlug;
		},
		isCurrentPage() {
			if (this.currentPage == this.title) {
				return {
                    color: '#1691b7',
                }
			} else {
				return {
                    color: '#222',
                }
			}
		},
	},
	computed: {
		indent() {
		  return { transform: `translate(${this.depth * 30}px)` }
		}
	}
}
</script>