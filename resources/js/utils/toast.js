import { useToast } from "primevue/usetoast";

export const useToastService = () => {
  const toast = useToast();

  const showToast = () => {
    toast.add({ severity: 'info', detail:'Hello' });
  }

  return { showToast };
};
