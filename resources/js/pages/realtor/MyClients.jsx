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
import { Plus, Edit, Eye, FileText, Phone, Mail } from 'lucide-react';

const MyClients = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const clients = [
        {
            id: 1,
            name: 'John Smith',
            email: 'john.smith@email.com',
            phone: '+1 (555) 777-8888',
            properties: 2,
            totalValue: '$875,000',
            joinDate: '2024-03-15',
            status: 'active',
            type: 'buyer',
            lastContact: '2025-11-15',
        },
        {
            id: 2,
            name: 'Robert Wilson',
            email: 'robert.w@email.com',
            phone: '+1 (555) 999-0000',
            properties: 3,
            totalValue: '$1,450,000',
            joinDate: '2023-11-08',
            status: 'active',
            type: 'investor',
            lastContact: '2025-11-12',
        },
        {
            id: 3,
            name: 'Lisa Anderson',
            email: 'lisa.a@email.com',
            phone: '+1 (555) 000-1111',
            properties: 1,
            totalValue: '$520,000',
            joinDate: '2024-08-12',
            status: 'active',
            type: 'seller',
            lastContact: '2025-11-10',
        },
        {
            id: 4,
            name: 'Michael Brown',
            email: 'michael.b@email.com',
            phone: '+1 (555) 123-4567',
            properties: 1,
            totalValue: '$395,000',
            joinDate: '2024-09-20',
            status: 'active',
            type: 'buyer',
            lastContact: '2025-11-18',
        },
        {
            id: 5,
            name: 'Sarah Davis',
            email: 'sarah.d@email.com',
            phone: '+1 (555) 234-5678',
            properties: 0,
            totalValue: '$0',
            joinDate: '2024-11-01',
            status: 'pending',
            type: 'buyer',
            lastContact: '2025-11-16',
        },
    ];

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>My Clients</Heading>
                <Button leftIcon={<Plus size={20} />} colorScheme="blue">
                    Add Client
                </Button>
            </HStack>

            <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                <Table variant="simple">
                    <Thead>
                        <Tr>
                            <Th>Client</Th>
                            <Th>Contact</Th>
                            <Th>Type</Th>
                            <Th>Properties</Th>
                            <Th>Total Value</Th>
                            <Th>Last Contact</Th>
                            <Th>Status</Th>
                            <Th>Actions</Th>
                        </Tr>
                    </Thead>
                    <Tbody>
                        {clients.map((client) => (
                            <Tr key={client.id}>
                                <Td>
                                    <HStack spacing={3}>
                                        <Avatar size="sm" name={client.name} />
                                        <Text fontWeight="semibold">{client.name}</Text>
                                    </HStack>
                                </Td>
                                <Td>
                                    <VStack align="start" spacing={1}>
                                        <HStack spacing={2}>
                                            <Mail size={14} />
                                            <Text fontSize="sm">{client.email}</Text>
                                        </HStack>
                                        <HStack spacing={2}>
                                            <Phone size={14} />
                                            <Text fontSize="sm">{client.phone}</Text>
                                        </HStack>
                                    </VStack>
                                </Td>
                                <Td>
                                    <Badge
                                        colorScheme={
                                            client.type === 'investor'
                                                ? 'purple'
                                                : client.type === 'seller'
                                                ? 'orange'
                                                : 'blue'
                                        }
                                    >
                                        {client.type}
                                    </Badge>
                                </Td>
                                <Td>{client.properties}</Td>
                                <Td fontWeight="bold" color="green.600">
                                    {client.totalValue}
                                </Td>
                                <Td fontSize="sm">{client.lastContact}</Td>
                                <Td>
                                    <Badge
                                        colorScheme={
                                            client.status === 'active'
                                                ? 'green'
                                                : client.status === 'pending'
                                                ? 'yellow'
                                                : 'gray'
                                        }
                                    >
                                        {client.status}
                                    </Badge>
                                </Td>
                                <Td>
                                    <HStack spacing={2}>
                                        <IconButton
                                            icon={<Eye size={16} />}
                                            size="sm"
                                            colorScheme="blue"
                                            variant="ghost"
                                            aria-label="View client"
                                        />
                                        <IconButton
                                            icon={<Phone size={16} />}
                                            size="sm"
                                            colorScheme="green"
                                            variant="ghost"
                                            aria-label="Call client"
                                        />
                                        <IconButton
                                            icon={<FileText size={16} />}
                                            size="sm"
                                            colorScheme="purple"
                                            variant="ghost"
                                            aria-label="View documents"
                                        />
                                        <IconButton
                                            icon={<Edit size={16} />}
                                            size="sm"
                                            colorScheme="orange"
                                            variant="ghost"
                                            aria-label="Edit client"
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

export default MyClients;
