<div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60">
                                            <div class="flex min-h-screen items-center justify-center px-4" @click.self="sExpedienteModal = false">
                                                <div
                                                    x-show="sExpedienteModal"
                                                    x-transition
                                                    x-transition.duration.300
                                                    class="panel my-8 w-[90%] max-w-lg overflow-hidden rounded-lg border-0 p-0 md:w-full"
                                                >
                                                    <button
                                                        type="button"
                                                        class="absolute top-4 text-white-dark hover:text-dark ltr:right-4 rtl:left-4"
                                                        @click="sExpedienteModal = false"
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24px"
                                                            height="24px"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="h-6 w-6"
                                                        >
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                    <div class="p-5">
                                                        <form>
                                                            <div class="mb-5">
                                                                <label for="file">Expediente de estudiante(s)</label>
                                                                <input
                                                                    id="file"
                                                                    type="text"
                                                                    placeholder="2022"
                                                                    class="form-input"
                                                                    
                                                                />
                                                            </div>
                                                            
                                                            <div class="mt-8 flex items-center justify-end">
                                                                <button
                                                                    type="submit"
                                                                    class="btn btn-primary ltr:ml-4 rtl:mr-4"
                                                                    x-text="params.id ? 'Update' : 'Add'"
                                                                ></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
