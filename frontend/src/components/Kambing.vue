<script setup lang="ts">
import { ref } from "vue";
import { fetchKambings, parseCategory } from "../helpers";
import { ctx } from "../main";

const kambings = ref([] as any[]);

const fetchKambingsData = async () => {
  const d = await fetchKambings();

  if (d) {
    kambings.value = d;
  }
};

const selectedFilter = ref(null as number | null);
const baseUrl = import.meta.env.VITE_APP_BASE_URL;

const deleteK = async (k: any) => {
  if (!window.confirm("Really delete?")) {
    return;
  }

  await fetch(`${import.meta.env.VITE_APP_BASE_URL}/api/kambings/${k?.id}`, {
    method: "delete",
  });

  fetchKambingsData();
};

const filterCat = (e: Event) => {
  // alert((e.target as HTMLInputElement).value);

  let val = null;
  if (!isNaN(parseInt((e.target as HTMLInputElement).value))) {
    val = parseInt((e.target as HTMLInputElement).value);
  }

  selectedFilter.value = val;
};

fetchKambingsData();
</script>

<template>
  <div class="px-3">
    <div v-if="ctx.token">
      <a href="/#/kambings/new"
        ><button class="btn btn-sm btn-primary">Add</button></a
      >
    </div>
    <div>
      <div><h4>List Kambing</h4></div>
    </div>

    <div>
      <select
        @input="
          (v) => {
            filterCat(v);
          }
        "
      >
        <option :value="null">Semua ({{ kambings.length }})</option>
        <option :value="0">
          Kecil ({{ kambings.filter((k) => k?.category === 0)?.length }})
        </option>
        <option :value="1">
          Sedang ({{ kambings.filter((k) => k?.category === 1)?.length }})
        </option>
        <option :value="2">
          Super ({{ kambings.filter((k) => k?.category === 2)?.length }})
        </option>
      </select>
    </div>
    <div class="d-flex justify-content-between flex-wrap">
      <div
        v-for="k in kambings.filter((k) =>
          selectedFilter ? k?.category === selectedFilter : true
        )"
      >
        <div
          class="d-flex align-items-center justify-content-center shadow shadow-md"
          style="height: 25vh; width: 45vw"
        >
          <img
            :src="`${baseUrl}/api/kambings/${k?.id}/photo`"
            style="max-width: 45vw; max-height: 25vh"
          />
        </div>
        <div class="my-1">
          <strong>{{ k?.name }}</strong>
        </div>
        <div>
          Rp{{
            Intl.NumberFormat("id-ID", { minimumFractionDigits: 2 }).format(
              k?.price ?? 0
            )
          }}
        </div>
        <div>{{ parseCategory(k?.category) }}</div>
        <div>
          <a
            :href="`https://wa.me/6281295113878?text=${encodeURIComponent(
              `Halo. Saya ingin memesan kambing ${k?.name} tipe ${parseCategory(
                k?.category
              )} seharga Rp${Intl.NumberFormat(`id-ID`, {
                minimumFractionDigits: 2,
              }).format(k?.price ?? 0)}.`
            )}`"
            target="_blank"
          >
            <button class="btn btn-sm btn-success w-100">Order</button>
          </a>
        </div>

        <div class="my-3" v-if="ctx.token">
          <button
            class="btn btn-sm btn-danger w-100"
            @click="
              () => {
                deleteK(k);
              }
            "
          >
            Delete
          </button>
        </div>

        <div class="my-3" v-if="ctx.token">
          <a :href="`/#/kambings/${k?.id}`">
            <button class="btn btn-sm btn-info w-100">Edit</button>
          </a>
        </div>

        <div class="md-3"><hr class="border border-dark" /></div>
      </div>
    </div>
  </div>
</template>
