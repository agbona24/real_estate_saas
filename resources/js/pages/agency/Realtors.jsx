import React from 'react';
import {
    Box,
    Button,
    Heading,
    Table,
    Thead,
    Tbody,
    Tr,
    Th,
    Td,
    Badge,
    IconButton,
    useColorModeValue,
    HStack,
    Avatar,
    VStack,
    Text,
} from '@chakra-ui/react';
import { Plus, Edit, Trash2, Mail, Phone } from 'lucide-react';

const Realtors = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const realtors = [
        {
            id: 1,
            name: 'Sarah Johnson',
            email: 'sarah.j@agency.com',
            phone: '+1 (555) 123-4567',
            properties: 34,
            activeLeads: 12,
            closedDeals: 45,
            revenue: '$2.3M',
            status: 'active',
            avatar: null,
        },
        {
            id: 2,
            name: 'Michael Chen',
            email: 'michael.c@agency.com',
            phone: '+1 (555) 234-5678',
            properties: 28,
            activeLeads: 8,
            closedDeals: 38,
            revenue: '$1.9M',
            status: 'active',
            avatar: null,
        },
        {
            id: 3,
            name: 'David Kim',
            email: 'david.k@agency.com',
            phone: '+1 (555) 345-6789',
            properties: 41,
            activeLeads: 15,
            closedDeals: 52,
            revenue: '$2.8M',
            status: 'active',
            avatar: null,
        },
        {
            id: 4,
            name: 'Jessica Martinez',
            email: 'jessica.m@agency.com',
            phone: '+1 (555) 456-7890',
            properties: 19,
            activeLeads: 6,
            closedDeals: 23,
            revenue: '$1.2M',
            status: 'active',
            avatar: null,
        },
        {
            id: 5,
            name: 'Robert Taylor',
            email: 'robert.t@agency.com',
            phone: '+1 (555) 567-8901',
            properties: 15,
            activeLeads: 4,
            closedDeals: 18,
            revenue: '$890K',
            status: 'inactive',
            avatar: null,
        },
    ];

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>Realtors</Heading>
                <Button leftIcon={<Plus size={20} />} colorScheme="blue">
                    Add Realtor
                </Button>
            </HStack>

            <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                <Table variant="simple">
                    <Thead>
                        <Tr>
                            <Th>Realtor</Th>
                            <Th>Contact</Th>
                            <Th>Properties</Th>
                            <Th>Active Leads</Th>
                            <Th>Closed Deals</Th>
                            <Th>Total Revenue</Th>
                            <Th>Status</Th>
                            <Th>Actions</Th>
                        </Tr>
                    </Thead>
                    <Tbody>
                        {realtors.map((realtor) => (
                            <Tr key={realtor.id}>
                                <Td>
                                    <HStack spacing={3}>
                                        <Avatar size="sm" name={realtor.name} src={realtor.avatar} />
                                        <Text fontWeight="semibold">{realtor.name}</Text>
                                    </HStack>
                                </Td>
                                <Td>
                                    <VStack align="start" spacing={1}>
                                        <HStack spacing={2}>
                                            <Mail size={14} />
                                            <Text fontSize="sm">{realtor.email}</Text>
                                        </HStack>
                                        <HStack spacing={2}>
                                            <Phone size={14} />
                                            <Text fontSize="sm">{realtor.phone}</Text>
                                        </HStack>
                                    </VStack>
                                </Td>
                                <Td>{realtor.properties}</Td>
                                <Td>{realtor.activeLeads}</Td>
                                <Td>{realtor.closedDeals}</Td>
                                <Td fontWeight="bold" color="green.600">
                                    {realtor.revenue}
                                </Td>
                                <Td>
                                    <Badge colorScheme={realtor.status === 'active' ? 'green' : 'gray'}>
                                        {realtor.status}
                                    </Badge>
                                </Td>
                                <Td>
                                    <HStack spacing={2}>
                                        <IconButton
                                            icon={<Edit size={16} />}
                                            size="sm"
                                            colorScheme="blue"
                                            variant="ghost"
                                            aria-label="Edit realtor"
                                        />
                                        <IconButton
                                            icon={<Trash2 size={16} />}
                                            size="sm"
                                            colorScheme="red"
                                            variant="ghost"
                                            aria-label="Delete realtor"
                                        />
                                    </HStack>
                                </Td>
                            </Tr>
                        ))}
                    </Tbody>
                </Table>
            </Box>
        </Box>
    );
};

export default Realtors;
