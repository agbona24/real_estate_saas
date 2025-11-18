import React from 'react';
import {
    Box,
    Button,
    Heading,
    useColorModeValue,
    HStack,
    VStack,
    Text,
    Grid,
    Icon,
    Badge,
    Tabs,
    TabList,
    TabPanels,
    Tab,
    TabPanel,
    Switch,
    FormControl,
    FormLabel,
    Input,
} from '@chakra-ui/react';
import { Eye, Save, Layout, Palette, Settings, Globe, Home, Building2, Mail } from 'lucide-react';

const SectionCard = ({ title, description, icon, isActive, onToggle }) => {
    const bgColor = useColorModeValue('white', 'gray.800');

    return (
        <Box bg={bgColor} p={5} borderRadius="lg" shadow="sm" border="1px" borderColor={isActive ? 'blue.500' : 'gray.200'}>
            <HStack justify="space-between" mb={3}>
                <HStack spacing={3}>
                    <Icon as={icon} color="blue.500" fontSize="24px" />
                    <VStack align="start" spacing={0}>
                        <Text fontWeight="semibold">{title}</Text>
                        <Text fontSize="sm" color="gray.500">
                            {description}
                        </Text>
                    </VStack>
                </HStack>
                <Switch isChecked={isActive} onChange={onToggle} colorScheme="blue" />
            </HStack>
        </Box>
    );
};

const WebsiteBuilder = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>Website Builder</Heading>
                <HStack spacing={3}>
                    <Button leftIcon={<Eye size={20} />} variant="outline">
                        Preview Website
                    </Button>
                    <Button leftIcon={<Save size={20} />} colorScheme="blue">
                        Publish Changes
                    </Button>
                </HStack>
            </HStack>

            <Tabs variant="enclosed" colorScheme="blue">
                <TabList>
                    <Tab>
                        <Icon as={Layout} mr={2} />
                        Sections
                    </Tab>
                    <Tab>
                        <Icon as={Palette} mr={2} />
                        Design
                    </Tab>
                    <Tab>
                        <Icon as={Settings} mr={2} />
                        Settings
                    </Tab>
                    <Tab>
                        <Icon as={Globe} mr={2} />
                        SEO
                    </Tab>
                </TabList>

                <TabPanels>
                    {/* Sections Tab */}
                    <TabPanel>
                        <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                            <Heading size="md" mb={4}>
                                Website Sections
                            </Heading>
                            <Text color="gray.600" mb={6}>
                                Enable or disable sections of your website
                            </Text>
                            <VStack spacing={4} align="stretch">
                                <SectionCard
                                    title="Hero Section"
                                    description="Large banner with your agency tagline"
                                    icon={Home}
                                    isActive={true}
                                />
                                <SectionCard
                                    title="Featured Properties"
                                    description="Showcase your best properties"
                                    icon={Building2}
                                    isActive={true}
                                />
                                <SectionCard
                                    title="About Us"
                                    description="Tell your agency's story"
                                    icon={Building2}
                                    isActive={true}
                                />
                                <SectionCard
                                    title="Our Realtors"
                                    description="Display your team members"
                                    icon={Building2}
                                    isActive={true}
                                />
                                <SectionCard
                                    title="Testimonials"
                                    description="Client reviews and feedback"
                                    icon={Building2}
                                    isActive={false}
                                />
                                <SectionCard
                                    title="Contact Form"
                                    description="Let clients reach out to you"
                                    icon={Mail}
                                    isActive={true}
                                />
                            </VStack>
                        </Box>
                    </TabPanel>

                    {/* Design Tab */}
                    <TabPanel>
                        <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                            <Heading size="md" mb={6}>
                                Design Customization
                            </Heading>
                            <VStack spacing={5} align="stretch">
                                <FormControl>
                                    <FormLabel>Theme</FormLabel>
                                    <Grid templateColumns="repeat(3, 1fr)" gap={4}>
                                        <Box
                                            p={4}
                                            borderRadius="lg"
                                            border="2px"
                                            borderColor="blue.500"
                                            cursor="pointer"
                                            bg="gray.50"
                                        >
                                            <Badge colorScheme="blue" mb={2}>
                                                Active
                                            </Badge>
                                            <Text fontWeight="semibold">Modern Luxury</Text>
                                        </Box>
                                        <Box p={4} borderRadius="lg" border="1px" borderColor="gray.200" cursor="pointer">
                                            <Text fontWeight="semibold">Classic Professional</Text>
                                        </Box>
                                        <Box p={4} borderRadius="lg" border="1px" borderColor="gray.200" cursor="pointer">
                                            <Text fontWeight="semibold">Coastal Breeze</Text>
                                        </Box>
                                    </Grid>
                                </FormControl>

                                <FormControl>
                                    <FormLabel>Primary Color</FormLabel>
                                    <HStack spacing={4}>
                                        <Input type="color" w="100px" defaultValue="#3182CE" />
                                        <Input defaultValue="#3182CE" />
                                    </HStack>
                                </FormControl>

                                <FormControl>
                                    <FormLabel>Secondary Color</FormLabel>
                                    <HStack spacing={4}>
                                        <Input type="color" w="100px" defaultValue="#38B2AC" />
                                        <Input defaultValue="#38B2AC" />
                                    </HStack>
                                </FormControl>

                                <FormControl>
                                    <FormLabel>Font Family</FormLabel>
                                    <HStack spacing={4}>
                                        <Button variant={true ? 'solid' : 'outline'} colorScheme="blue">
                                            Inter
                                        </Button>
                                        <Button variant="outline">Roboto</Button>
                                        <Button variant="outline">Playfair Display</Button>
                                        <Button variant="outline">Montserrat</Button>
                                    </HStack>
                                </FormControl>

                                <FormControl>
                                    <FormLabel>Logo</FormLabel>
                                    <Button size="sm">Upload Logo</Button>
                                    <Text fontSize="sm" color="gray.500" mt={2}>
                                        Recommended size: 200x60px
                                    </Text>
                                </FormControl>
                            </VStack>
                        </Box>
                    </TabPanel>

                    {/* Settings Tab */}
                    <TabPanel>
                        <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                            <Heading size="md" mb={6}>
                                Website Settings
                            </Heading>
                            <VStack spacing={5} align="stretch">
                                <FormControl>
                                    <FormLabel>Website Title</FormLabel>
                                    <Input defaultValue="Prime Realty Agency - Your Dream Home Awaits" />
                                </FormControl>

                                <FormControl>
                                    <FormLabel>Custom Domain</FormLabel>
                                    <Input defaultValue="www.primerealty.com" />
                                    <Text fontSize="sm" color="gray.500" mt={2}>
                                        Configure DNS settings to point to our servers
                                    </Text>
                                </FormControl>

                                <FormControl>
                                    <FormLabel>Contact Email</FormLabel>
                                    <Input type="email" defaultValue="info@primerealty.com" />
                                </FormControl>

                                <FormControl>
                                    <FormLabel>Social Media</FormLabel>
                                    <VStack spacing={3} align="stretch">
                                        <Input placeholder="Facebook URL" />
                                        <Input placeholder="Instagram URL" />
                                        <Input placeholder="Twitter URL" />
                                        <Input placeholder="LinkedIn URL" />
                                    </VStack>
                                </FormControl>
                            </VStack>
                        </Box>
                    </TabPanel>

                    {/* SEO Tab */}
                    <TabPanel>
                        <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                            <Heading size="md" mb={6}>
                                SEO Settings
                            </Heading>
                            <VStack spacing={5} align="stretch">
                                <FormControl>
                                    <FormLabel>Meta Title</FormLabel>
                                    <Input defaultValue="Prime Realty - Premier Real Estate Agency in New York" />
                                    <Text fontSize="sm" color="gray.500" mt={1}>
                                        60 characters recommended
                                    </Text>
                                </FormControl>

                                <FormControl>
                                    <FormLabel>Meta Description</FormLabel>
                                    <Input defaultValue="Find your dream home with Prime Realty. Expert real estate services in New York. Browse luxury properties, condos, and houses." />
                                    <Text fontSize="sm" color="gray.500" mt={1}>
                                        160 characters recommended
                                    </Text>
                                </FormControl>

                                <FormControl>
                                    <FormLabel>Meta Keywords</FormLabel>
                                    <Input defaultValue="real estate, New York, luxury homes, properties, realtors" />
                                </FormControl>

                                <FormControl>
                                    <FormLabel>Google Analytics ID</FormLabel>
                                    <Input placeholder="G-XXXXXXXXXX" />
                                </FormControl>

                                <FormControl>
                                    <FormLabel>Facebook Pixel ID</FormLabel>
                                    <Input placeholder="Enter Facebook Pixel ID" />
                                </FormControl>
                            </VStack>
                        </Box>
                    </TabPanel>
                </TabPanels>
            </Tabs>
        </Box>
    );
};

export default WebsiteBuilder;
