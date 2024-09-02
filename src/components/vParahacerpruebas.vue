<template>
  <v-container>
    <v-data-table
      :headers="headers"
      :items="categories"
      item-value="name"
      class="elevation-1"
    >
      <template v-slot:item.name="{ item }">
        <v-expansion-panels v-model="expandedItems" multiple>
          <v-expansion-panel :value="expandedItems.includes(item.name)">
            <v-expansion-panel-title @click="toggleItem(item.name)">
              {{ item.name }}
            </v-expansion-panel-title>
            <v-expansion-panel-text>
              <v-list dense>
                <v-list-item
                  v-for="(subItem, idx) in item.items"
                  :key="idx"
                >
                  <v-list-item-content>{{ subItem }}</v-list-item-content>
                </v-list-item>
              </v-list>
            </v-expansion-panel-text>
          </v-expansion-panel>
        </v-expansion-panels>
      </template>
    </v-data-table>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      headers: [
        { text: 'Category', value: 'name' }
      ],
      categories: [
        {
          name: 'Category 1',
          items: ['Item 1.1', 'Item 1.2']
        },
        {
          name: 'Category 2',
          items: ['Item 2.1', 'Item 2.2', 'Item 2.3']
        }
      ],
      expandedItems: []  // Array to track expanded items
    }
  },
  methods: {
    toggleItem(itemName) {
      const index = this.expandedItems.indexOf(itemName);
      if (index === -1) {
        this.expandedItems.push(itemName);  // Expand item
      } else {
        this.expandedItems.splice(index, 1);  // Collapse item
      }
    }
  }
}
</script>